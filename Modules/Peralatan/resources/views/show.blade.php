@extends('layouts.app')

@section('title', 'Detail ' . $peralatan->nama_peralatan)

@section('content')
    <div class="top">
        <h2>Detail Peralatan</h2>
        <a href="{{ route('peralatan.index') }}" class="btn btn-light">&larr; Kembali</a>
    </div>

    <div class="card" style="max-width: 560px; margin: 0 auto;">
        <h3 style="margin-bottom: 12px;">{{ $peralatan->nama_peralatan }}</h3>

        <p>Kategori: <b>{{ $peralatan->kategori }}</b></p>
        <p>Stok: <b>{{ $peralatan->stok }} unit</b></p>
        <p>Harga sewa: <b>Rp {{ number_format($peralatan->harga_sewa, 0, ',', '.') }}</b></p>
        <p>Kondisi: <b>{{ $peralatan->kondisi }}</b></p>
        <p style="opacity: .7; font-size: 13px; margin-top: 10px;">
            Ditambahkan {{ $peralatan->created_at->format('d M Y, H:i') }}
        </p>

        <div class="aksi" style="margin-top: 20px;">
            <a href="{{ route('peralatan.edit', $peralatan) }}" class="btn btn-warning">Ubah</a>
            <form action="{{ route('peralatan.destroy', $peralatan) }}" method="POST"
                  onsubmit="return confirm('Hapus peralatan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
@endsection