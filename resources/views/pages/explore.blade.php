@extends('layouts.app')

@section('content')
    <div id="explore" class="container">
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
                Sorry, this should be a social network 
                but we do not have enough active people. Come and be the first to <a class="link-clean" href="{{route('post.create')}}"> Post</a> something
            </div>
        @endif
    </div>
    <script src="{{ asset('js/functions.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
@endsection