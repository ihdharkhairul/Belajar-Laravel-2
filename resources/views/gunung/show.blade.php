@extends('layouts.app')

@section('title', 'Detail ' . $gunung->nama_gunung)

@section('content')
    <div class="top">
        <h2>Detail Gunung</h2>
        <a href="{{ route('gunung.index') }}" class="btn btn-light">&larr; Kembali</a>
    </div>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="card" style="max-width: 760px; margin: 0 auto;">
        {{-- Foto (ditampilkan lewat symbolic link public/storage) --}}
        @if ($gunung->foto)
            <img src="{{ asset('storage/' . $gunung->foto) }}" alt="{{ $gunung->nama_gunung }}"
                 style="width: 100%; max-height: 380px; object-fit: cover; border-radius: 14px; margin-bottom: 18px; display: block;">
        @else
            <div style="width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; border-radius: 14px; margin-bottom: 18px; opacity: .6; border: 1px dashed currentColor;">
                Belum ada foto
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 6px;">
            <h3 style="margin: 0;">{{ $gunung->nama_gunung }}</h3>
            <x-status-badge :status="$gunung->tingkat_kesulitan" />
        </div>
        <p style="opacity: .75; margin-bottom: 16px;">{{ $gunung->lokasi }}</p>

        <p>Ketinggian: <b>{{ number_format($gunung->ketinggian, 0, ',', '.') }} mdpl</b></p>
        <p>Harga tiket: <b>Rp {{ number_format($gunung->harga_tiket, 0, ',', '.') }}</b></p>
        <p>Tingkat kesulitan: <b>{{ $gunung->tingkat_kesulitan }}</b></p>

        <p style="margin-top: 14px;">
            {{ $gunung->deskripsi ?: 'Belum ada deskripsi.' }}
        </p>

        {{-- Tombol kelola hanya untuk user yang sudah login --}}
        @auth
            <div class="aksi" style="margin-top: 20px;">
                <a href="{{ route('gunung.edit', $gunung) }}" class="btn btn-warning">Ubah</a>
                <form action="{{ route('gunung.destroy', $gunung) }}" method="POST"
                      onsubmit="return confirm('Hapus gunung ini? Booking untuk gunung ini ikut terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        @endauth
    </div>
@endsection