<div class="field">
    <label for="nama_peralatan">Nama Peralatan</label>
    <input type="text" id="nama_peralatan" name="nama_peralatan"
           value="{{ old('nama_peralatan', $peralatan->nama_peralatan ?? '') }}">
    @error('nama_peralatan') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="kategori">Kategori</label>
    <input type="text" id="kategori" name="kategori" placeholder="Contoh: Tenda, Tas, Masak"
           value="{{ old('kategori', $peralatan->kategori ?? '') }}">
    @error('kategori') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" min="0"
           value="{{ old('stok', $peralatan->stok ?? '') }}">
    @error('stok') <span class="error-text">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="harga_sewa">Harga Sewa per Hari (Rp)</label>
    <input type="number" id="harga_sewa" name="harga_sewa" min="0"
           value="{{ old('harga_sewa', $peralatan->harga_sewa ?? '') }}">
    @error('harga_sewa') <span class="error-text">{{ $message }}</span> @enderror
</div>