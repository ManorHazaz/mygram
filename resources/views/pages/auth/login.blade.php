@extends('layouts.app')

@section('content')
    <div class="container auth-container">
        <x-images />
        <div class="content login-content">
            <form action="{{ route('login') }}" method="POST" class="login-form form">
                <h1 class="company-name"> Mygram </h1>
                @csrf

                <input required name="email" id="email" type="email" class="text-input @error('email') error-input @enderror" placeholder="Email" value="{{ old('email') }}"/>
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
                <input required name="password" id="password" type="password" class="text-input @error('password') error-input @enderror" placeholder="Password" />
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror

                @if (session('status'))
                    <input id="status-msg" type="hidden" value="{{ session('status') }}" />
                    <script>
                        window.addEventListener('load', (event) => {
                            creatToast(3000, 'error', _('#status-msg').value);
                        });
                    </script>
                @endif

                <span class="remember-span">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Remember me </label>
                </span>

                <input type="submit" class="btn" name="submit" value="Log In">
                <span class="line">OR</span>
                <i class="fab fa-facebook-square"></i>
                <a class="facebook"> Log in with Facebook</a>
                <a class="link-clean forgot-password"> Forgot password? </a>
                
            </form>
            <span class="switch-span">
                Don't have an account? <a href="{{ route('register') }}" class="link-clean">Sign up</a>
            </span>
        </div>  
    </div>
@endsection