<?php

namespace Modules\Peralatan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Peralatan\Http\Requests\PeralatanRequest;
use Modules\Peralatan\Models\Peralatan;

class PeralatanController extends Controller
{
    public function index()
    {
        return view('peralatan::index', [
            'peralatan' => Peralatan::orderBy('nama_peralatan')->get(),
        ]);
    }

    public function create()
    {
        return view('peralatan::create');
    }

    public function store(PeralatanRequest $request)
    {
        Peralatan::create($request->validated());

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function show(Peralatan $peralatan)
    {
        return view('peralatan::show', ['peralatan' => $peralatan]);
    }

    public function edit(Peralatan $peralatan)
    {
        return view('peralatan::edit', ['peralatan' => $peralatan]);
    }

    public function update(PeralatanRequest $request, Peralatan $peralatan)
    {
        $peralatan->update($request->validated());

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();

        return redirect()->route('peralatan.index')
            ->with('success', 'Peralatan berhasil dihapus.');
    }
}