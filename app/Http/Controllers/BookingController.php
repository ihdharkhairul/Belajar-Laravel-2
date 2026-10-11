<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Gunung;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::with('gunung')->latest()->get();
        return view('booking.index', ['booking' => $booking]);
    }

    public function create()
    {
        $gunung = Gunung::orderBy('nama_gunung')->get();
        return view('booking.create', ['gunung' => $gunung]);
    }

    public function store(Request $request)
    {
        Booking::create($this->validasi($request));

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    public function edit(Booking $booking)
    {
        $gunung = Gunung::orderBy('nama_gunung')->get();
        return view('booking.edit', ['booking' => $booking, 'gunung' => $gunung]);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($this->validasi($request));

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'gunung_id'      => 'required|exists:gunung,id',
            'nama_pendaki'   => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'tanggal_naik'   => 'required|date',
            'jumlah_pendaki' => 'required|integer|min:1|max:50',
            'status'         => 'required|in:Menunggu,Dikonfirmasi,Dibatalkan',
        ]);
    }
}