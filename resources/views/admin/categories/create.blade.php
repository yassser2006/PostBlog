@extends('layouts.app')
@section('content')
    @include('admin.includes.error')
    <div class="card">
        <div class="card-header">
            Create a new category
        </div>
        <div class="card-body">
            <form action="{{route('category.store')}}" method="post" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop