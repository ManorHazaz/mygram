@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content data-manage">
            <x-sidenav :user="$user"/>
            <form action="{{ route('profile.update', $user->profile) }}" enctype="multipart/form-data" method="POST" class="data-form edit-profile">
                @csrf
                @method('PATCH')
                <h1 class="form-title">Profile edit</h1>

                @if ($user->profile->image)
                    <img class="profile-image" src="{{url($user->profile->image)}}" />
                @else
                    <img class="profile-image" src="{{url('/static/unknownUser.jpg')}}" />
                @endif

                
                <div class="data-manage-div add-file-div">
                    <span class="add-file"></span>
                    <input type="file" class="file-upload @error('image') error-input @enderror" id="image" name="image" />
                    @error('image')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="data-manage-div">
                    <span>Title</span>
                    <input name="title" id="title" type="text" class="text-input @error('title') error-input @enderror" placeholder="Title" value="{{ old('title') ?? $user->profile->title }}"/>
                    @error('title')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="data-manage-div">
                    <span>Description</span>
                    <textarea name="description" id="description" type="text" class="text-input text-area @error('description') error-input @enderror" value="{{ old('description') ?? $user->profile->description }}"></textarea>
                    @error('description')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="data-manage-div">
                    <span>url</span>
                    <input name="url" id="url" type="text" class="text-input @error('url') error-input @enderror" placeholder="Url" value="{{ old('url') ?? $user->profile->url }}"/>
                    @error('url')
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
    
                <input type="submit" class="btn" name="submit" value="Save changes">
            </form>
        </div>
    </div>
@endsection