@extends('layouts.app')

@section('content')

    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">My profile</h2>
        </div>

        <div class="panel-body">
            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar:</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                </div>

                <div class="form-group">
                    <label for="facebook">User facebook:</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" value ="{{ Auth::user()->profile->facebook }}">
                </div>

                <div class="form-group">
                    <label for="youtube">User youtube:</label>
                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ Auth::user()->profile->youtube }}">
                </div>
                <div class="form-group">
                    <label for="youtube">About me:</label>
                    <textarea name="about" id="about" cols="6" rows="6" class="form-control">{{ Auth::user()->profile->about }}</textarea>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-block" type="submit">Update profile</button>
                </div>


            </form>
        </div>

    </div>



@endsection