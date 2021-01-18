@extends('layouts.app')

@section('content')
    <div class="container auth-container">
        <x-images />
        <div class="content register-content">
            <form action="{{ route('register') }}" method="POST" class="signup-form form">
                <h1 class="company-name"> Mygram </h1>
                @csrf

                <input required name="email" id="email" type="email" class="text-input @error('email') error-input @enderror" placeholder="Email" value="{{ old('email') }}"/>
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror

                <input required name="fullname" id="fullname" type="text" class="text-input @error('fullname') error-input @enderror" placeholder="Full name" value="{{ old('fullname') }}"/>
                @error('fullname')
                    <span class="input-error">{{ $message }}</span>
                @enderror

                <input required name="username" id="username" type="text" class="text-input @error('username') error-input @enderror" placeholder="User name" value="{{ old('username') }}"/>
                @error('username')
                    <span class="input-error">{{ $message }}</span>
                @enderror
                
                <input required name="password" id="password" type="password" class="text-input @error('password') error-input @enderror" placeholder="Password" />
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror

                <input required name="password_confirmation" id="password_confirmation" type="password" class="text-input" placeholder="Password confirmation" />
                
                @if (session('status'))
                    <input id="status-msg" type="hidden" value="{{ session('status') }}" />
                    <script>
                        window.addEventListener('load', (event) => {
                            creatToast(3000, 'error', _('#status-msg').value);
                        });
                    </script>
                @endif

                <input type="submit" class="btn signup-btn" name="submit" value="Sign up">
                <p class="terms">By signing up, you agree to our Terms , Data Policy and Cookies Policy .</p>            
            </form>
            <span class="switch-span signup-span">
                have an account? <a  href="{{ route('login') }}" class="link-clean">Sign in</a>
            </span>
        </div>
    </div>
@endsection