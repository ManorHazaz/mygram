@extends('layouts.app')

@section('content')
<div class="container">
    <div class="post">
        <div class="image">
            <img src="{{url($post->image)}}" />
        </div>
        <div class="post-data">
            <div class="post-title">
                @if ($post->user->profile->image)
                    <img class="profile-image small-profile-image" src="{{url($post->user->profile->image)}}" />
                @else
                <img class="profile-image small-profile-image" src="{{url('/static/unknownUser.jpg')}}" />
                @endif
                <a class="username link-clean" href="{{ route('user.index' , $post->user) }}">{{ $post->user->username }}</a>
                @if ($post->user->username != auth()->user()->username)
                    <form class="form-follow" action="{{ route('follow.user', $post->user) }}" method="POST">
                        @csrf
                        @if (auth()->user()->following->contains($post->user->id))
                            <button class="btn-Follow btn-clean" type="submit">Unfollow</button>
                        @else
                            <button class="btn-Follow btn-clean" type="submit">Follow</button>
                        @endif
                    </form>
                @endif
                @can('delete', $post)
                    <div class="post-delete">
                        <form action="{{ route('post.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-clean">Delete</button>
                        </form>
                    </div>
                @endcan  
            </div>
            <div class="post-info">
                <span class="comment description">
                    @if ($post->user->profile->image)
                        <img class="profile-image small-profile-image" src="{{url($post->user->profile->image)}}" />
                    @else
                        <img class="profile-image small-profile-image" src="{{url('/static/unknownUser.jpg')}}" />
                    @endif
                    <div class="body">
                        <a class="username link-clean" href="{{ route('user.index' , $post->user) }}">{{ $post->user->username }}</a>
                        <p>{{$post->description}}</p>
                    </div>
                </span>
                @if ($post->comments)
                    @foreach ($post->comments as $comment)
                        <x-comment :comment="$comment"/>
                    @endforeach    
                @endif
            </div>
            <div class="post-actions">
                @auth
                    @if(!$post->likedBy(auth()->user()))
                        <div class="like-toggle">
                            <form action="{{ route('like.post', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-clean like">Like</button>
                            </form>
                        </div>                   
                    @else
                        <div class="like-toggle">
                            <form action="{{ route('like.post', $post ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-clean like">Unlike</button>
                            </form>
                        </div>
                    @endif           
                @endauth
                <p class="likes-count"><b>{{ $post->likes->count() }}</b> {{ Str::plural('like',$post->likes->count()) }}</p>
                <span class="time-created">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="post-create-comment">
                @auth
                    <form action="{{ route('comment.post', $post) }}" method="POST">
                        @csrf
                        <input type="text" class="text-input" id="body" name="body" placeholder="Add a comment..."/>
                        <button type="submit" class="btn-clean">Post</button>
                    </form>     
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection