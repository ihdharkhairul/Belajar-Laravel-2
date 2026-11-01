@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
    <div class="top">
        <h2>Detail Booking</h2>
        <a href="{{ route('booking.index') }}" class="btn btn-light">&larr; Kembali</a>
    </div>

    <div class="card" style="max-width: 560px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h3 style="margin: 0;">{{ $booking->nama_pendaki }}</h3>
            <x-status-badge :status="$booking->status" />
        </div>

        <p>No. HP: <b>{{ $booking->no_hp }}</b></p>
        <p>Gunung:
            <b><a href="{{ route('gunung.show', $booking->gunung) }}">{{ $booking->gunung->nama_gunung }}</a></b>
            ({{ number_format($booking->gunung->ketinggian, 0, ',', '.') }} mdpl)
        </p>
        <p>Tanggal naik: <b>{{ $booking->tanggal_naik->format('d M Y') }}</b></p>
        <p>Jumlah pendaki: <b>{{ $booking->jumlah_pendaki }} orang</b></p>
        <p style="opacity: .7; font-size: 13px; margin-top: 10px;">
            Dibuat {{ $booking->created_at->format('d M Y, H:i') }}
        </p>

        <div class="aksi" style="margin-top: 20px;">
            <a href="{{ route('booking.edit', $booking) }}" class="btn btn-warning">Ubah</a>
            <form action="{{ route('booking.destroy', $booking) }}" method="POST"
                  onsubmit="return confirm('Hapus booking ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
@endsection