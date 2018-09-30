@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Title
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Trash
                </th>
                </thead>
                <tbody>
                @if($posts->count() > 0)
                @foreach($posts->all() as $post)
                    <tr>
                        <td>
                            <img src="{{$post->featured}}" width="58px" height="58px" alt="{{$post->title}}">
                        </td>
                        <td>
                            {{$post->title}}
                        </td>
                        <td>
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-info">
                                Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{route('post.delete',$post->id)}}" class="btn btn-sm btn-danger">
                                Trash
                            </a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">
                            There is no posts yet.
                        </th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop