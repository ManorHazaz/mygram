<div class="user-info">
    <div class="profilepicture">
        @if ($user->profile->image)
            <img src="{{url($user->profile->image)}}" />
        @else
            <img src="{{url('/static/unknownUser.jpg')}}" />
        @endif
        
    </div>
    <div class="data">
        <h1 class="username">{{ $user->username }}</h1>
        @auth
            @if ($user->username == auth()->user()->username)
                <a href="{{ route('user.edit', $user) }}" class="settings fas fa-cog fa-2x"></a>
            @else
                <form class="form-follow" action="{{ route('follow.user', $user) }}" method="POST">
                    @csrf
                    @if (auth()->user()->following->contains($user->id))
                        <button class="btn-Follow" type="submit">Unfollow</button>
                    @else
                        <button class="btn-Follow" type="submit">Follow</button>
                    @endif

                </form>
            @endif
        @endauth
        <table>
            <tr>
                <td> <b>{{$user->posts->count()}}</b> {{ Str::plural('post', $user->posts->count()) }}</td>
                <td> <b>{{$user->profile->followers->count()}}</b> followers </td>
                <td> <b>{{$user->following->count()}}</b> following </td>
            </tr>
        </table>
        <p class="title">{{ $user->profile->title }}</p>
        <p class="Description">{{ $user->profile->description }}</p>
        <a href="{{ $user->profile->url }}" class="url">{{ $user->profile->url }}</a>
        
    </div>
    <span class="placeholder"></span>
</div>