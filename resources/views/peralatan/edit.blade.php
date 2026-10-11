@extends('layouts.app')

@section('title', 'Ubah Peralatan')

@section('content')
    <div class="top">
        <h2>Ubah Peralatan</h2>
    </div>

    <div class="card">
        <form action="{{ route('peralatan.update', $peralatan) }}" method="POST">
            @csrf
            @method('PUT')
            @include('peralatan._form')

            <button type="submit" class="btn">Perbarui</button>
            <a href="{{ route('peralatan.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection