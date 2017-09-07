@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Restore</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @foreach($trashed_posts as $trashed_post )
                    <tr>
                        <td><img src="{{ $trashed_post->featured }}" alt="{{ $trashed_post->slug }}" title="{{ $trashed_post->slug }}" width="50px" height="50px"></td>
                        <td>{{ $trashed_post->title }}</td>
                        <td>
                            <a href="{{ route('post.restore',['id' => $trashed_post->id]) }} " class="btn btn-success btn-sm">Restore</a>
                        </td>
                        <td>
                            <a href="{{ route('post.kill',['id' => $trashed_post->id]) }} " class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop