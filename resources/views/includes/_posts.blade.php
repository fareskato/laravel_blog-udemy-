<div class="panel panel-default">
    <div class="panel-heading">
         <a data-toggle="collapse" href="#posts"><b>Posts</b></a>
    </div>
    <div id="posts" class="panel-collapse collapse">
      <ul class="list-group">
        <li class="list-group-item"><a href="{{ route('post.create') }}">Create post</a></li>
        <li class="list-group-item"><a href="{{ route('post') }}">All posts</a></li>
        <li class="list-group-item"><a href="{{ route('post.trash') }}">Trashed posts </a></li>
      </ul>
    </div>
</div>