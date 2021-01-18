@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($posts->count())
            <div class="paginate-data">
                @foreach ($posts as $post)
                    <x-post :post="$post"/>
                @endforeach
            </div>
            <div class="load-more">
                <input type="hidden" id="laravel-url-page" value="{{ $posts->url(1) }}" />
                <input type="hidden" id="laravel-last-page" value="{{ $posts->lastPage() + 1 }}" />
                <span class="loader"></span>
            </div>
        @else
            <div class="msg-div">
                It's look like you didn't follow no one yet or the people you are following didn't upload posts yet. Come and find new people to follow <a class="link-clean" href="{{route('explore')}}"> Here.</a>
            </div>
        @endif

        <a href="{{ route('post.create') }}" class="add-post link-clean"> + </a>
    </div>
    <script src="{{ asset('js/functions.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
@endsection