@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ $category->name }}  : details</h2>
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <p>
                    {{ $category->description }}
                </p>
            </div>
        </div>
    </div>


@stop