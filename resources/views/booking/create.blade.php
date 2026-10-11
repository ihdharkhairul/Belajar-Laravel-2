@extends('layouts.app')

@section('title', 'Tambah Booking')

@section('content')
    <div class="top">
        <h2>Tambah Booking</h2>
    </div>

    <div class="card">
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            @include('booking._form')

            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('booking.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection