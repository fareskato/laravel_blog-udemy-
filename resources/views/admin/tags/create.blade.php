@extends('layouts.app')

@section('content')
    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Create new Tag</h2>
        </div>
        <div class="panel-body">
            <form action="{{ route('tag.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Tag Name</label>
                    <input type="text" name="tag" id="tag" class="form-control" placeholder="Enter tag name">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-primary btn-block" type="submit">Store tag</button>
                    </div>
                    <hr>
                    <div class="text-left">
                        <a class="btn btn-success" href="{{ route('tag') }}" >All tags</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop