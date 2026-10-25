@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="top">
        <h2>Daftar Akun</h2>
    </div>

    <div class="card" style="max-width: 480px; margin: 0 auto;">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" autofocus>
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn">Register</button>
            <a href="{{ route('login') }}" class="btn btn-light">Sudah punya akun?</a>
        </form>
    </div>
@endsection