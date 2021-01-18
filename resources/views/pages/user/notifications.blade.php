@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($notifications->count())
            <div class="paginate-data">
                @foreach ($notifications as $notification)
                    <x-notification :notification="$notification" />
                @endforeach
            </div>
            <div class="load-more">
                <input type="hidden" id="laravel-url-page" value="{{ $notifications->url(1) }}" />
                <input type="hidden" id="laravel-last-page" value="{{ $notifications->lastPage() + 1 }}" />
                <span class="loader"></span>
            </div>
        @else
            <div class="msg-div">
                You don't have any notifications.
            </div>
        @endif
    </div>
    <script src="{{ asset('js/functions.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
@endsection