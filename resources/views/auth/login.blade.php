@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="top">
        <h2>Login</h2>
    </div>

    <div class="card" style="max-width: 480px; margin: 0 auto;">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label style="display:flex; align-items:center; gap:8px;">
                    <input type="checkbox" name="remember" style="width:auto;"> Ingat saya
                </label>
            </div>

            <button type="submit" class="btn">Login</button>
            <a href="{{ route('register') }}" class="btn btn-light">Buat akun</a>
        </form>
    </div>
@endsection