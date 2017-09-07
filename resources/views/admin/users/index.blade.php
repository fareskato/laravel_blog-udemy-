@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">All Users</h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                @if(count($users) > 0)
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Delete</th>
                    </tr>
                @endif
                </thead>
                <tbody>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ asset($user->profile->avatar)}}" alt="" width="70px" height="70px"></td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if($user->admin)
                                    <a href="{{ route('user.notAdmin', ['id' => $user->id]) }}" class="btn btn-xs btn-danger">Remove admin</a>
                                @else
                                    <a href="{{ route('user.admin', ['id' => $user->id]) }}" class="btn btn-xs btn-success">Make admin</a>
                                @endif

                            </td>
                            <td>
                                @if(Auth::id() != $user->id)
                                    <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>
    </div>

@stop