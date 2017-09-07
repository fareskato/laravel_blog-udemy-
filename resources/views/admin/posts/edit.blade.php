@extends('layouts.app')

@section('content')

    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Edit post : {{ $post->title }}</h2>
        </div>

        <div class="panel-body">
            <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="featured">Featured image:</label>
                    <input type="file" class="form-control" id="featured" name="featured">
                </div>
                <div class="form-group">
                    <label for="category">Select category</label>
                    <select class="form-control"  name="category_id" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if($post->category->id == $category->id)
                                selected
                                @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                              @foreach($post->tags as $post_tag)
                                  @if($tag->id == $post_tag->id)
                                    checked
                                  @endif
                              @endforeach
                            >{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="5" cols="5">{{ $post->content }}</textarea>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-block" type="submit">Update post</button>
                </div>


            </form>
        </div>

    </div>



@endsection

{{-- summernote editor --}}
@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });

    </script>

@stop