<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/toast.css')}}">
    <link rel="icon" href="{{url('/static/favicon.jpg')}}">
    <title>Mygram</title>
</head>
<body>
    @auth
    <nav class="top-nav">
        <span class="logo"> Mygram </span>
        <form class="search-form" action="{{ route('dashboard.search') }}" method="POST">
            @csrf
            <input class="search-input" type="search" name="search" id="search" placeholder="   Search">
            <button class="btn-clean" type="submit"><a class="link-icon fas fa-search"></a></button>
        </form>

        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="link-icon fas fa-home fa-2x"></a>
            </li>            
            <li>
                <a href="{{ route('explore') }}" class="link-icon fas fa-globe-europe fa-2x"></a>
            </li>            
            <li>
                <a href="{{ route('user.notifications' , auth()->user()) }}" class="notifications-link link-icon far fa-heart fa-2x">
                <span class="notifications-count @if(auth()->user()->unreadNotifications->count() ==0) hidden @endif">{{ auth()->user()->unreadNotifications->count() }}</span>
                </a>
            </li>                       
            <li>
                <a href="{{ route('user.index' , auth()->user()) }}" class="link-icon fas fa-user-circle fa-2x"></a>
            </li>                       
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-clean" type="submit"><a class="link-icon fas fa-sign-out-alt fa-2x"></a></button>
                </form>
            </li>
        </ul>
    </nav>
    @endauth
    @yield('content')
</body>
<script src="{{ asset('js/functions.js')}}"></script>
<script src="{{ asset('js/toast.js')}}"></script>
</html>