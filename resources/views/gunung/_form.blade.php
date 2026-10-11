<div class="field">
    <label for="nama_gunung">Nama Gunung</label>
    <input type="text" id="nama_gunung" name="nama_gunung"
           value="{{ old('nama_gunung', $gunung->nama_gunung ?? '') }}">
    @error('nama_gunung') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="lokasi">Lokasi</label>
    <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Garut, Jawa Barat"
           value="{{ old('lokasi', $gunung->lokasi ?? '') }}">
    @error('lokasi') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="ketinggian">Ketinggian (mdpl)</label>
    <input type="number" id="ketinggian" name="ketinggian" min="1"
           value="{{ old('ketinggian', $gunung->ketinggian ?? '') }}">
    @error('ketinggian') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="tingkat_kesulitan">Tingkat Kesulitan</label>
    <select id="tingkat_kesulitan" name="tingkat_kesulitan">
        @foreach (['Mudah', 'Sedang', 'Sulit'] as $level)
            <option value="{{ $level }}"
                {{ old('tingkat_kesulitan', $gunung->tingkat_kesulitan ?? 'Mudah') == $level ? 'selected' : '' }}>
                {{ $level }}
            </option>
        @endforeach
    </select>
    @error('tingkat_kesulitan') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="harga_tiket">Harga Tiket (Rp)</label>
    <input type="number" id="harga_tiket" name="harga_tiket" min="0"
           value="{{ old('harga_tiket', $gunung->harga_tiket ?? '') }}">
    @error('harga_tiket') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="deskripsi">Deskripsi (opsional)</label>
    <textarea id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $gunung->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="foto">Foto Gunung (opsional, maks. 2 MB)</label>

    @if (isset($gunung) && $gunung->foto)
        <img src="{{ asset('storage/' . $gunung->foto) }}" alt="Foto saat ini"
             style="width: 160px; height: 100px; object-fit: cover; border-radius: 12px; margin-bottom: 10px; display: block;">
    @endif

    <input type="file" id="foto" name="foto" accept="image/*">
    @error('foto') <span class="error-text">{{ $message }}</span> @enderror
</div>