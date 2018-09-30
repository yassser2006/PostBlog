<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        if($categories->count()==0) {
            Session::flash('info', 'Create a new category first');
            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required|max:255',
            'featured'=>'required|image',
            'content1'=>'required',
            'category_id'=>'required'
        ]);
        $featured=$request->featured;
        $featured_new_name=time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);
        $post=Post::create([
            'title'=>$request->title,
            'content'=>$request->content1,
            'featured'=>'uploads/posts/'.$featured_new_name,
            'category_id'=>$request->category_id,
            'slug'=>str_slug($request->title)

        ]);
        Session::flash('success','Post Created successfuly');
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);
        return view('admin.posts.edit')->with('post',$post)->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'title'=>'required|max:255',
            'content1'=>'required',
            'category_id'=>'required'
        ]);
        $post=Post::find($id);
        if ($request->hasFile('featured')) {
            $featured = $request->featured;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);
            $post->featured='uploads/posts/'.$featured_new_name;

        }

        $post->title=$request->title;
        $post->content=$request->content1;
        $post->category_id=$request->category_id;
        $post->save();
        Session::flash('success','You successfully updated a category');
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        Session::flash('success','You successfully trashed a post');
        // $category->save();
        return redirect()->route('posts');
    }

    public function restore($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        Session::flash('success','You successfully restored a post');
        return redirect()->route('post.trashed');

    }

    public function trashed(){
        $post=Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts',$post);

    }

    public function kill($id){
        $post=Post::withTrashed()->where('id',$id);
        $post->forceDelete();
        Session::flash('success','You successfully deleted a post permanently');

        return redirect()->route('post.trashed');
    }
}
