@extends('layouts.app')

@section('content')
    <div class="container">
        <x-user :user="$user"/>  
        
        @if ($user->posts)
            @foreach ($user->posts as $post)
                <x-post :post="$post"/>
            @endforeach
        @else
            <p>{{ $user->username }} has no posts</p>
        @endif
    </div>
@endsection