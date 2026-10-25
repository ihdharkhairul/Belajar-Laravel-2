@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="top">
        <h2>Profil Saya</h2>
    </div>

    <div class="card" style="max-width: 560px;">
        <p><b>Nama:</b> {{ Auth::user()->name }}</p>
        <p><b>Email:</b> {{ Auth::user()->email }}</p>
        <p><b>Akun dibuat:</b> {{ Auth::user()->created_at->format('d M Y, H:i') }}
            ({{ Auth::user()->created_at->diffForHumans() }})</p>
    </div>
@endsection