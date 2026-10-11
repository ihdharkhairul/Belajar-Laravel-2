<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatan = Peralatan::orderBy('nama_peralatan')->get();
        return view('peralatan.index', ['peralatan' => $peralatan]);
    }

    public function create()
    {
        return view('peralatan.create');
    }

    public function store(Request $request)
    {
        Peralatan::create($this->validasi($request));

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit(Peralatan $peralatan)
    {
        return view('peralatan.edit', ['peralatan' => $peralatan]);
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $peralatan->update($this->validasi($request));

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama_peralatan' => 'required|string|max:255',
            'kategori'       => 'required|string|max:100',
            'stok'           => 'required|integer|min:0',
            'harga_sewa'     => 'required|integer|min:0',
        ]);
    }
}