@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
            <th>
                Category name
            </th>
            <th>
                Deleting
            </th>
            <th>
                Editing
            </th>
            </thead>
            <tbody>
            @if($categories->count() > 0)
            @foreach($categories->all() as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-info">
                            Edit
                        </a>
                    </td>
                    <td>
                        <a href="{{route('category.delete',$category->id)}}" class="btn btn-sm btn-danger">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <th colspan="5" class="text-center">
                        There is no categories yet.
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
@stop