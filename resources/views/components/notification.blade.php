<div class="notification @if ($notification->read_at != null) read @endif">

    {{ $profileImage = $notification->user->profile->image }}
    
    @if( $notification->type === "App\Notifications\likeNotification" )
        @if ($profileImage == null)
            <img class="profile-image small-profile-image user-image" src="{{url('/static/unknownUser.jpg')}}" />            
        @else
            <img src="{{ $profileImage }}" />
        @endif
        <p class="messege">{{ $notification->user->username }} liked your post</p>
        <img class="profile-image small-profile-image post-image" src=" {{ url(auth()->user()->posts->where('id',$notification->data['post_id'])->first()->image) }} ">
    @endif

    @if( $notification->type === "App\Notifications\CommentNotification" )
        @if ($profileImage == null)
            <img class="profile-image small-profile-image user-image" src="{{url('/static/unknownUser.jpg')}}" />            
        @else
            <img src="{{ $profileImage }}" />
        @endif
        <p class="messege">{{ $notification->user->username }} comment on your post</p>
        <img class="profile-image small-profile-image post-image" src=" {{ url(auth()->user()->posts->where('id',$notification->data['post_id'])->first()->image) }} ">
    @endif

    @if( $notification->type === "App\Notifications\FollowNotification" )
        @if ($profileImage == null)
            <img class="profile-image small-profile-image user-image" src="{{url('/static/unknownUser.jpg')}}" />            
        @else
            <img src="{{ $profileImage }}" />
        @endif
        <p class="messege">{{ $notification->user->username }} start following you</p>
    @endif

</div>