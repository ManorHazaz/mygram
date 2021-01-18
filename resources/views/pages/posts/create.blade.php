@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content data-manage">
        <form action="{{ route('post.create') }}" enctype="multipart/form-data" method="POST" class="data-form" >
            @csrf
            <h1 class="username"> New Post </h1>

            <div class="data-manage-div">
                <span>Description</span>
                <textarea name="description" id="description" type="text" class="text-input text-area @error('description') error-input @enderror" placeholder="Description" value="{{ old('description') }}"></textarea>
                @error('description')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="data-manage-div">
                <span>Image</span>
                <input type="file" class="file-upload @error('image') error-input @enderror" id="image" name="image" />
                @error('image')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
            
            
            @if (session('status'))
                <input id="status-msg" type="hidden" value="{{ session('status') }}" />
                <script>
                    window.addEventListener('load', (event) => {
                        creatToast(3000, 'error', _('#status-msg').value);
                    });
                </script>
            @endif

            <input type="submit" class="btn" name="submit" value="Upload Post">
        </form>
    </div>
</div>

@endsection