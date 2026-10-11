@extends('layouts.app')

@section('title', 'Daftar Booking')

@section('content')
    <div class="top">
        <h2>Daftar Booking</h2>
        <a href="{{ route('booking.create') }}" class="btn">+ Tambah Booking</a>
    </div>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <table>
        <tr>
            <th>No</th>
            <th>Pendaki</th>
            <th>Gunung</th>
            <th>Tanggal Naik</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($booking as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $item->nama_pendaki }}<br>
                    <small>{{ $item->no_hp }}</small>
                </td>
                <td>{{ $item->gunung->nama_gunung }}</td>
                <td>{{ $item->tanggal_naik->format('d M Y') }}</td>
                <td>{{ $item->jumlah_pendaki }} orang</td>
                <td><x-status-badge :status="$item->status" /></td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('booking.edit', $item) }}" class="btn btn-warning">Ubah</a>
                        <form action="{{ route('booking.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="empty">Belum ada data booking.</td>
            </tr>
        @endforelse
    </table>
@endsection