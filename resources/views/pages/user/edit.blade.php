@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content data-manage">
            <x-sidenav :user="$user"/>
            <form action="{{ route('user.update', $user) }}" method="POST" class="data-form edit-user">
                @csrf
                @method('PATCH')
                <h1 class="form-title">User edit</h1>
            
                <div class="data-manage-div">
                    <span>Full name</span>
                    <input name="fullname" id="fullname" type="text" class="text-input @error('url') error-input @enderror" placeholder="Full name" value="{{ old('url') ?? $user->fullname }}"/>
                    @error('fullname')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="data-manage-div">
                    <span>Password</span>
                    <input name="password" id="password" type="password" class="text-input @error('url') error-input @enderror" placeholder="Password" />
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="data-manage-div">
                    <span>Password confirmation</span>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="text-input" placeholder="Password confirmation" />
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

            <div class="user-delete">
                <form action="{{ route('user.destroy', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Delete user</button>
                </form>
            </div>
        </div>
    </div>
@endsection