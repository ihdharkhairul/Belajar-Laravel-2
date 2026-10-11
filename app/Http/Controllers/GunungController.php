<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GunungController extends Controller
{
    public function index()
    {
        $gunung = Gunung::orderBy('nama_gunung')->get();
        return view('gunung.index', ['gunung' => $gunung]);
    }

    public function create()
    {
        return view('gunung.create');
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        unset($data['foto']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('gunung', 'public');
        }

        Gunung::create($data);

        return redirect()->route('gunung.index')
            ->with('success', 'Data gunung berhasil ditambahkan.');
    }

    public function edit(Gunung $gunung)
    {
        return view('gunung.edit', ['gunung' => $gunung]);
    }

    public function update(Request $request, Gunung $gunung)
    {
        $data = $this->validasi($request);
        unset($data['foto']);

        if ($request->hasFile('foto')) {
            if ($gunung->foto) {
                Storage::disk('public')->delete($gunung->foto);
            }
            $data['foto'] = $request->file('foto')->store('gunung', 'public');
        }

        $gunung->update($data);

        return redirect()->route('gunung.index')
            ->with('success', 'Data gunung berhasil diperbarui.');
    }

    public function destroy(Gunung $gunung)
    {
        if ($gunung->foto) {
            Storage::disk('public')->delete($gunung->foto);
        }

        $gunung->delete();

        return redirect()->route('gunung.index')
            ->with('success', 'Data gunung berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama_gunung'       => 'required|string|max:255',
            'lokasi'            => 'required|string|max:255',
            'ketinggian'        => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:Mudah,Sedang,Sulit',
            'harga_tiket'       => 'required|integer|min:0',
            'deskripsi'         => 'nullable|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}