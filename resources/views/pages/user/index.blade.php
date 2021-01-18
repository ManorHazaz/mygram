@extends('layouts.app')

@section('content')
    <div class="container">
        <x-user :user="$user"/>

        <div class="paginate-data small-images-posts">
            @if ($posts)
                @foreach ($posts as $post)
                    <x-postImage :post="$post"/>
                @endforeach
            @else
                <p>{{ $user->username }} has no posts</p>
            @endif
        </div>
        <div class="load-more">
            <input type="hidden" id="laravel-url-page" value="{{ $posts->url(1) }}" />
            <input type="hidden" id="laravel-last-page" value="{{ $posts->lastPage() + 1 }}" />
            <span class="loader"></span>
        </div>
    </div>
    <script src="{{ asset('js/functions.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
@endsection