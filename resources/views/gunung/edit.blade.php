@extends('layouts.app')

@section('title', 'Ubah Gunung')

@section('content')
    <div class="top">
        <h2>Ubah Gunung</h2>
    </div>

    <div class="card">
        <form action="{{ route('gunung.update', $gunung) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('gunung._form')

            <button type="submit" class="btn">Perbarui</button>
            <a href="{{ route('gunung.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
@endsection