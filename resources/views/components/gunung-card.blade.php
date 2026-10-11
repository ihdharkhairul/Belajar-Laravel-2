@props(['gunung'])

<div class="gunung-card">
    @if ($gunung->foto)
        <img class="foto" src="{{ asset('storage/' . $gunung->foto) }}" alt="{{ $gunung->nama_gunung }}">
    @else
        <div class="foto foto-kosong">Belum ada foto</div>
    @endif

    <div class="card-top">
        <h3>{{ $gunung->nama_gunung }}</h3>
        <x-status-badge :status="$gunung->tingkat_kesulitan" />
    </div>
    <div class="lokasi">{{ $gunung->lokasi }}</div>

    <p>Ketinggian: <b>{{ number_format($gunung->ketinggian, 0, ',', '.') }} mdpl</b></p>
    <p>Tiket: <b>Rp {{ number_format($gunung->harga_tiket, 0, ',', '.') }}</b></p>
    @if ($gunung->deskripsi)
        <p>{{ $gunung->deskripsi }}</p>
    @endif

    {{ $slot }}
</div>