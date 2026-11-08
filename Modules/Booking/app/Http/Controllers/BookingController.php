<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gunung;
use Illuminate\Support\Facades\Storage;
use Modules\Booking\Http\Requests\BookingRequest;
use Modules\Booking\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking::index', [
            'gunung' => Gunung::orderBy('nama_gunung')->get(),
        ]);
    }

    public function getData()
    {
        $data = Booking::with('gunung')->latest()->get()->map(fn ($b) => [
            'id'             => $b->id,
            'nama_gunung'    => $b->gunung?->nama_gunung,
            'nama_pendaki'   => $b->nama_pendaki,
            'no_hp'          => $b->no_hp,
            'tanggal_naik'   => $b->tanggal_naik->format('d-m-Y'),
            'jumlah_pendaki' => $b->jumlah_pendaki,
            'status'         => $b->status,
            'nama_bukti'     => $b->nama_bukti,
            'bukti_url'      => $b->bukti_bayar ? asset('storage/'.$b->bukti_bayar) : null,
        ]);

        return response()->json($data);
    }

    public function store(BookingRequest $request)
    {
        $data = $request->safe()->except('bukti_bayar');

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $data['nama_bukti']  = $file->getClientOriginalName();
            $data['bukti_bayar'] = $file->store('bukti_booking', 'public');
        }

        Booking::create($data);

        return response()->json(['message' => 'Booking berhasil ditambahkan.']);
    }

    public function edit(Booking $booking)
    {
        return response()->json([
            'id'             => $booking->id,
            'gunung_id'      => $booking->gunung_id,
            'nama_pendaki'   => $booking->nama_pendaki,
            'no_hp'          => $booking->no_hp,
            'tanggal_naik'   => $booking->tanggal_naik->format('Y-m-d'),
            'jumlah_pendaki' => $booking->jumlah_pendaki,
            'status'         => $booking->status,
            'nama_bukti'     => $booking->nama_bukti,
            'bukti_url'      => $booking->bukti_bayar ? asset('storage/'.$booking->bukti_bayar) : null,
        ]);
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $data = $request->safe()->except('bukti_bayar');

        if ($request->hasFile('bukti_bayar')) {
            if ($booking->bukti_bayar) {
                Storage::disk('public')->delete($booking->bukti_bayar);
            }
            $file = $request->file('bukti_bayar');
            $data['nama_bukti']  = $file->getClientOriginalName();
            $data['bukti_bayar'] = $file->store('bukti_booking', 'public');
        }

        $booking->update($data);

        return response()->json(['message' => 'Booking berhasil diperbarui.']);
    }

    public function destroy(Booking $booking)
    {
        if ($booking->bukti_bayar) {
            Storage::disk('public')->delete($booking->bukti_bayar);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking berhasil dihapus.']);
    }
}