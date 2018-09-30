@extends('layouts.app')
@section('content')
    @include('admin.includes.error')
    <div class="card">
        <div class="card-header">
            Edit post: {{$post->title}}
        </div>
        <div class="card-body">
            <form action="{{route('post.update',[$post->id])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{$post->title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="featured">Featured image</label>
                    <input type="file" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"  >{{$category->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content1">Content</label>
                    <textarea name="content1" id="content1" cols="5" rows="5" class="form-control">{{$post->content}}</textarea>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop