@extends('layouts.app')

@section('content')
    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Create new category</h2>
        </div>
        <div class="panel-body">
            <form action="{{ route('category.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" placeholder="Enter description here!" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-primary btn-block" type="submit">Store Category</button>
                    </div>
                    <hr>
                    <div class="text-left">
                        <a class="btn btn-success" href="{{ route('category') }}" >All categories</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop