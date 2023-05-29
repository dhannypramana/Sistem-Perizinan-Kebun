@extends('services.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/license_generator.css') }}">
@endsection

@section('container')
    <h2>Format Surat Balasan Praktikum</h2>

    <img src="{{ asset('/assets/images/kop.png') }}" alt="Kop Surat" class="kop">

    <div class="form-group mt-3">
        <label for="title">Judul</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Judul Surat" required>
    </div>
@endsection
