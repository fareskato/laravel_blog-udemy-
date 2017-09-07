@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">All Tags</h2>
            <a class="text-right" href="{{ route('tag.create') }}">Create Tag</a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                @if(count($tags) > 0)
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                @endif
                </thead>
                <tbody>
                    @if(count($tags) > 0)
                        @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->tag }}</td>
                            <td><a href="{{ route('tag.edit', ['id' => $tag->id]) }}" class="btn btn-success btn-sm">Edit</a></td>
                            <td><a href="{{ route('tag.delete', ['id' => $tag->id]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                        @endforeach
                    @else
                        <tr><h4>There are no tags click <a href="{{ route('tag.create') }}">here</a>  to create new one </h4></tr>
                    @endif
                </tbody>
            </table>
        </div>

        </div>
    </div>

@stop