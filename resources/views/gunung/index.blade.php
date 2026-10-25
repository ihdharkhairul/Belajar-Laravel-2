@extends('layouts.app')

@section('title', 'Daftar Gunung')

@section('content')
    <div class="top">
        <h2>Daftar Gunung</h2>
        @auth
            <a href="{{ route('gunung.create') }}" class="btn">+ Tambah Gunung</a>
        @endauth
    </div>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="grid">
        @forelse ($gunung as $item)
            <x-gunung-card :gunung="$item">
                @auth
                    <div class="aksi">
                        <a href="{{ route('gunung.edit', $item) }}" class="btn btn-warning">Ubah</a>
                        <form action="{{ route('gunung.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus gunung ini? Booking untuk gunung ini ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                @endauth
            </x-gunung-card>
        @empty
            <p class="empty">Belum ada data gunung.</p>
        @endforelse
    </div>
@endsection