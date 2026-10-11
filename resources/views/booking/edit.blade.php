@extends('layouts.app')

@section('title', 'Ubah Booking')

@section('content')
    <div class="top">
        <h2>Ubah Booking</h2>
    </div>

    <div class="card">
        <form action="{{ route('booking.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            @include('booking._form')

            <button type="submit" class="btn">Perbarui</button>
            <a href="{{ route('booking.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection