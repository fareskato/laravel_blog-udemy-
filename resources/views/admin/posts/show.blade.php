@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center"> {{ $post->title }}</h2>
        </div>
        <div class="panel-body">
            <div class="col-sm-4">
                <img src="{{ $post->featured }}"  alt="{{ $post->title }}" width="100%">
            </div>
            <div class="col-sm-8">
                <p>
                    {{ $post->content }}
                </p>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-4">{{ $post->category->name }}</div>
                <div class="col-xs-4">{{ $post->created_at }}</div>
                <div class="col-xs-4">Author</div>
            </div>
        </div>
    </div>

@stop
