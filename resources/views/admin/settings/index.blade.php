@extends('layouts.app')

@section('content')

    {{-- Display errors --}}
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Main Settings</h2>
        </div>

        <div class="panel-body">
            <form action="{{ route('settings.update') }}" method="post" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="site_name">Site name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value=" {{ $settings->site_name }}">
                </div>
                <div class="form-group">
                    <label for="site_email">Site Email</label>
                    <input type="text" class="form-control" id="site_email" name="site_email" value=" {{ $settings->site_email }}">
                </div>
                <div class="form-group">
                    <label for="site_phone">Site Phone</label>
                    <input type="text" class="form-control" id="site_phone" name="site_phone" value=" {{ $settings->site_phone }}">
                </div>
                <div class="from-group">
                    <button class="btn btn-primary btn-block" type="submit">Edit settings</button>
                </div>

            </form>
        </div>

    </div>



@endsection



