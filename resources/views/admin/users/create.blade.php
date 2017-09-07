@extends('layouts.app')

@section('content')

    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Add new user</h2>
        </div>

        <div class="panel-body">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name here">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email here">
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-block" type="submit">Add user</button>
                </div>


            </form>
        </div>

    </div>



@endsection