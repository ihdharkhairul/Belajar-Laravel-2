@extends('layouts.app')

@section('title', 'Tambah Peralatan')

@section('content')
    <div class="top">
        <h2>Tambah Peralatan</h2>
    </div>

    <div class="card">
        <form action="{{ route('peralatan.store') }}" method="POST">
            @csrf
            @include('peralatan._form')

            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('peralatan.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection