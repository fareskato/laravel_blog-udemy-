@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">All Posts</h2>
            <a class="text-right" href="{{ route('post.create') }}">Create post</a>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                @if(count($posts) > 0)
                    <tr>
                        <th>Featured image</th>
                        <th>Title</th>
                        <th>category</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Trash</th>
                    </tr>
                @endif
                </thead>
                <tbody>
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ $post->featured }}" alt="{{ $post->slug }}" width="70px" height="70px"></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td><a href="{{ route('post.show',['id' => $post->id]) }}" class="btn btn-primary btn-sm">View</a></td>
                            <td><a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-success btn-sm">Edit</a></td>
                            <td><a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-danger btn-sm">Trash</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr><h4>There are no posts click <a href="{{ route('post.create') }}">here</a>  to create new one </h4></tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
    </div>

@stop