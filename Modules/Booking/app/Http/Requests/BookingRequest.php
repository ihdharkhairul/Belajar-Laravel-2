<?php

namespace Modules\Booking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gunung_id'      => 'required|exists:gunung,id',
            'nama_pendaki'   => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'tanggal_naik'   => 'required|date',
            'jumlah_pendaki' => 'required|integer|min:1|max:50',
            'status'         => 'required|in:Menunggu,Dikonfirmasi,Dibatalkan',
            'bukti_bayar'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'gunung_id.required'      => 'Gunung wajib dipilih.',
            'gunung_id.exists'        => 'Gunung tidak valid.',
            'nama_pendaki.required'   => 'Nama pendaki wajib diisi.',
            'no_hp.required'          => 'No HP wajib diisi.',
            'tanggal_naik.required'   => 'Tanggal naik wajib diisi.',
            'tanggal_naik.date'       => 'Format tanggal tidak valid.',
            'jumlah_pendaki.required' => 'Jumlah pendaki wajib diisi.',
            'jumlah_pendaki.min'      => 'Jumlah pendaki minimal 1.',
            'jumlah_pendaki.max'      => 'Jumlah pendaki maksimal 50.',
            'status.required'         => 'Status wajib dipilih.',
            'bukti_bayar.mimes'       => 'Berkas harus berformat JPG, JPEG, PNG, atau PDF.',
            'bukti_bayar.max'         => 'Ukuran berkas maksimal 2 MB.',
        ];
    }
}