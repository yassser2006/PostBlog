@extends('layouts.app')
@section('content')
    @include('admin.includes.error')
    <div class="card">
        <div class="card-header">
            Update category: {{$category->name}}
        </div>
        <div class="card-body">
            <form action="{{route('category.update',[$category->id])}}" method="post" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
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