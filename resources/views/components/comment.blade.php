<span class="comment">
    @if ($comment->user->profile->image)
        <img class="profile-image small-profile-image" src="{{url($comment->user->profile->image)}}" />
    @else
        <img class="profile-image small-profile-image" src="{{url('/static/unknownUser.jpg')}}" />
    @endif
    <div class="body">
        <a class="username link-clean" href="{{ route('user.index' , $comment->user) }}">{{ $comment->user->username }}</a>
        <p>{{$comment->body}}</p>
    </div>
    @can('delete', $comment)
    <div class="comment-delete">
        <form action="{{ route('post.comment.destroy', $comment) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-clean">Delete</button>
        </form>
    </div>
@endcan 
</span>