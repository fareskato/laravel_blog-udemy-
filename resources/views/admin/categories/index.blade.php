@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">All categories</h2>
            <a class="text-right" href="{{ route('category.create') }}">Create category</a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                @if(count($categories) > 0)
                    <tr>
                        <th>Name</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                @endif
                </thead>
                <tbody>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{ route('category.show',['id' => $category->id]) }}" class="btn btn-primary btn-sm">View</a></td>
                            <td><a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-success btn-sm">Edit</a></td>
                            <td><a href="{{ route('category.delete', ['id' => $category->id]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                        @endforeach
                    @else
                        <tr><h4>There are no categories click <a href="{{ route('category.create') }}">here</a>  to create new one </h4></tr>
                    @endif
                </tbody>
            </table>
        </div>

        </div>
    </div>

@stop