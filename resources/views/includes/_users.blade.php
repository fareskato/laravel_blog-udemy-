<div class="panel panel-default">
    <div class="panel-heading">
        <a data-toggle="collapse" href="#users"><b>Users</b></a>
    </div>
    <div id="users" class="panel-collapse collapse">
        <ul class="list-group">
            {{-- Check if the authenticated user is admin --}}
            @if(Auth::user()->admin)
                <li class="list-group-item"><a href="{{ route('user') }}">All users</a></li>
                <li class="list-group-item"><a href="{{ route('user.create') }}">Add user</a></li>
            @endif
            <li class="list-group-item"><a href="{{ route('user.profile') }}">My profile</a></li>
        </ul>
    </div>
</div>