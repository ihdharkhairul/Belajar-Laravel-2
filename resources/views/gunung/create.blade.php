@extends('layouts.app')

@section('title', 'Tambah Gunung')

@section('content')
    <div class="top">
        <h2>Tambah Gunung</h2>
    </div>

    <div class="card">
        <form action="{{ route('gunung.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('gunung._form')

            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('gunung.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection