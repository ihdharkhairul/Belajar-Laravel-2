<div class="field">
    <label for="gunung_id">Gunung</label>
    <select id="gunung_id" name="gunung_id">
        <option value="">-- Pilih gunung --</option>
        @foreach ($gunung as $g)
            <option value="{{ $g->id }}"
                {{ old('gunung_id', $booking->gunung_id ?? '') == $g->id ? 'selected' : '' }}>
                {{ $g->nama_gunung }} ({{ $g->ketinggian }} mdpl)
            </option>
        @endforeach
    </select>
    @error('gunung_id') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="nama_pendaki">Nama Pendaki</label>
    <input type="text" id="nama_pendaki" name="nama_pendaki"
           value="{{ old('nama_pendaki', $booking->nama_pendaki ?? '') }}">
    @error('nama_pendaki') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="no_hp">No. HP</label>
    <input type="text" id="no_hp" name="no_hp"
           value="{{ old('no_hp', $booking->no_hp ?? '') }}">
    @error('no_hp') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="tanggal_naik">Tanggal Naik</label>
    <input type="date" id="tanggal_naik" name="tanggal_naik"
           value="{{ old('tanggal_naik', isset($booking) ? $booking->tanggal_naik->format('Y-m-d') : '') }}">
    @error('tanggal_naik') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="jumlah_pendaki">Jumlah Pendaki</label>
    <input type="number" id="jumlah_pendaki" name="jumlah_pendaki" min="1"
           value="{{ old('jumlah_pendaki', $booking->jumlah_pendaki ?? 1) }}">
    @error('jumlah_pendaki') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="status">Status</label>
    <select id="status" name="status">
        @foreach (['Menunggu', 'Dikonfirmasi', 'Dibatalkan'] as $s)
            <option value="{{ $s }}"
                {{ old('status', $booking->status ?? 'Menunggu') == $s ? 'selected' : '' }}>
                {{ $s }}
            </option>
        @endforeach
    </select>
    @error('status') <span class="error-text">{{ $message }}</span> @enderror
</div>