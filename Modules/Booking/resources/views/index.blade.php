@extends('layouts.app')

@section('title', 'Booking')

@section('content')
    <style>
        dialog { margin: auto; width: min(460px, 92vw); padding: 24px; border-radius: 16px;
                 border: 1px solid var(--line); background: #12261f; color: var(--text); }
        dialog::backdrop { background: rgba(0,0,0,.6); }
        dialog label { display: block; margin: 12px 0 4px; font-size: 14px; }
        dialog input, dialog select { width: 100%; padding: 9px 12px; border-radius: 10px;
                 border: 1px solid var(--line); background: var(--glass); color: var(--text); font: inherit; }
        dialog select option { color: #000; }
        .err { color: var(--danger); font-size: 12px; margin-top: 3px; }
        .modal-actions { display: flex; gap: 8px; justify-content: flex-end; margin-top: 18px; }
        #alert-box { margin-bottom: 14px; }
    </style>

    <div class="top">
        <h2>Booking <small id="total-count"></small></h2>
        <button type="button" class="btn" id="btn-tambah">+ Tambah Booking</button>
    </div>

    <div id="alert-box"></div>

    <table>
        <thead>
            <tr>
                <th>No</th><th>Gunung</th><th>Pendaki</th><th>No HP</th>
                <th>Tanggal Naik</th><th>Jumlah</th><th>Status</th><th>Bukti</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody id="booking-body">
            <tr><td colspan="9" class="empty">Memuat data...</td></tr>
        </tbody>
    </table>

    <dialog id="modal-booking">
        <h3 id="modal-title">Tambah Booking</h3>
        <form id="form-booking" enctype="multipart/form-data">
            <input type="hidden" id="booking-id">

            <label for="gunung_id">Gunung</label>
            <select name="gunung_id" id="gunung_id">
                <option value="">-- Pilih gunung --</option>
                @foreach ($gunung as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_gunung }}</option>
                @endforeach
            </select>
            <div class="err" data-for="gunung_id"></div>

            <label for="nama_pendaki">Nama Pendaki</label>
            <input type="text" name="nama_pendaki" id="nama_pendaki">
            <div class="err" data-for="nama_pendaki"></div>

            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp">
            <div class="err" data-for="no_hp"></div>

            <label for="tanggal_naik">Tanggal Naik</label>
            <input type="date" name="tanggal_naik" id="tanggal_naik">
            <div class="err" data-for="tanggal_naik"></div>

            <label for="jumlah_pendaki">Jumlah Pendaki</label>
            <input type="number" name="jumlah_pendaki" id="jumlah_pendaki" min="1" max="50">
            <div class="err" data-for="jumlah_pendaki"></div>

            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Menunggu">Menunggu</option>
                <option value="Dikonfirmasi">Dikonfirmasi</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
            <div class="err" data-for="status"></div>

            <label for="bukti_bayar">Bukti Pembayaran (JPG/PNG/PDF, maks 2 MB)</label>
            <input type="file" name="bukti_bayar" id="bukti_bayar" accept=".jpg,.jpeg,.png,.pdf">
            <div class="err" data-for="bukti_bayar"></div>
            <div id="bukti-lama" style="font-size:13px;margin-top:4px"></div>

            <div class="modal-actions">
                <button type="button" class="btn btn-light" id="btn-batal">Batal</button>
                <button type="submit" class="btn" id="btn-simpan">Simpan</button>
            </div>
        </form>
    </dialog>
@endsection

@push('scripts')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    const modal = document.getElementById('modal-booking');
    const URL_DATA  = @json(route('booking.data'));
    const URL_STORE = @json(route('booking.store'));
    const URL_BASE  = @json(url('booking'));

    function escapeHtml(s) {
        return String(s ?? '').replace(/[&<>"']/g, c =>
            ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
    }

    function showAlert(msg, type = 'success') {
        const color = type === 'success' ? 'var(--accent)' : 'var(--danger)';
        $('#alert-box').html(
            '<div style="padding:10px 14px;border-radius:10px;border:1px solid ' + color + ';color:' + color + '">'
            + escapeHtml(msg) + '</div>'
        );
        setTimeout(() => $('#alert-box').empty(), 4000);
    }

    function clearErrors() { $('.err').text(''); }

    function loadData() {
        $.get(URL_DATA, function (rows) {
            $('#total-count').text('(' + rows.length + ')');
            if (!rows.length) {
                $('#booking-body').html('<tr><td colspan="9" class="empty">Belum ada data booking.</td></tr>');
                return;
            }
            let html = '';
            rows.forEach((r, i) => {
                const bukti = r.bukti_url
                    ? '<a href="' + escapeHtml(r.bukti_url) + '" target="_blank" rel="noopener">'
                      + escapeHtml(r.nama_bukti || 'Buka berkas') + '</a>'
                    : '-';
                html += '<tr>'
                    + '<td>' + (i + 1) + '</td>'
                    + '<td>' + escapeHtml(r.nama_gunung) + '</td>'
                    + '<td>' + escapeHtml(r.nama_pendaki) + '</td>'
                    + '<td>' + escapeHtml(r.no_hp) + '</td>'
                    + '<td>' + escapeHtml(r.tanggal_naik) + '</td>'
                    + '<td>' + escapeHtml(r.jumlah_pendaki) + '</td>'
                    + '<td>' + escapeHtml(r.status) + '</td>'
                    + '<td>' + bukti + '</td>'
                    + '<td><div class="aksi">'
                    + '<button class="btn btn-warning btn-edit" data-id="' + r.id + '">Ubah</button>'
                    + '<button class="btn btn-danger btn-hapus" data-id="' + r.id + '">Hapus</button>'
                    + '</div></td></tr>';
            });
            $('#booking-body').html(html);
        }).fail(function () {
            showAlert('Gagal memuat data.', 'error');
        });
    }

    function resetForm() {
        $('#form-booking')[0].reset();
        $('#booking-id').val('');
        $('#bukti-lama').empty();
        clearErrors();
    }

    $('#btn-tambah').on('click', function () {
        resetForm();
        $('#modal-title').text('Tambah Booking');
        modal.showModal();
    });

    $('#btn-batal').on('click', () => modal.close());

    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        resetForm();
        $.get(URL_BASE + '/' + id + '/edit', function (d) {
            $('#modal-title').text('Ubah Booking');
            $('#booking-id').val(d.id);
            $('#gunung_id').val(d.gunung_id);
            $('#nama_pendaki').val(d.nama_pendaki);
            $('#no_hp').val(d.no_hp);
            $('#tanggal_naik').val(d.tanggal_naik);
            $('#jumlah_pendaki').val(d.jumlah_pendaki);
            $('#status').val(d.status);
            if (d.bukti_url) {
                $('#bukti-lama').html('Berkas saat ini: <a href="' + escapeHtml(d.bukti_url)
                    + '" target="_blank" rel="noopener">' + escapeHtml(d.nama_bukti) + '</a>'
                    + ' (pilih berkas baru untuk menggantinya)');
            }
            modal.showModal();
        }).fail(() => showAlert('Data tidak ditemukan.', 'error'));
    });

    $('#form-booking').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const id = $('#booking-id').val();
        const fd = new FormData(this);
        let url = URL_STORE;
        if (id) {
            url = URL_BASE + '/' + id;
            fd.append('_method', 'PUT');
        }

        $('#btn-simpan').prop('disabled', true);

        $.ajax({
            url: url,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (res) {
                modal.close();
                showAlert(res.message);
                loadData();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (field, msgs) {
                        $('.err[data-for="' + field + '"]').text(msgs[0]);
                    });
                } else {
                    showAlert('Terjadi kesalahan (' + xhr.status + ').', 'error');
                }
            },
            complete: function () {
                $('#btn-simpan').prop('disabled', false);
            }
        });
    });

    $(document).on('click', '.btn-hapus', function () {
        if (!confirm('Hapus booking ini?')) return;
        $.ajax({
            url: URL_BASE + '/' + $(this).data('id'),
            type: 'DELETE',
            success: function (res) { showAlert(res.message); loadData(); },
            error: function () { showAlert('Gagal menghapus data.', 'error'); }
        });
    });

    loadData();
});
</script>
@endpush