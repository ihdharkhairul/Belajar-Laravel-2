@extends('layouts.app')

@section('title', 'Daftar Peralatan')

@section('content')
    <div class="top">
        <h2>Daftar Peralatan</h2>
        <a href="{{ route('peralatan.create') }}" class="btn">+ Tambah Peralatan</a>
    </div>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga Sewa</th>
            <th>Aksi</th>
        </tr>

        @forelse ($peralatan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_peralatan }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->stok }}</td>
                <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('peralatan.edit', $item) }}" class="btn btn-warning">Ubah</a>
                        <form action="{{ route('peralatan.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus peralatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="empty">Belum ada data peralatan.</td>
            </tr>
        @endforelse
    </table>
@endsection