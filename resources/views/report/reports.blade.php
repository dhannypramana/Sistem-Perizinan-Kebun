@extends('services.layouts.index')

@section('title')
    Managemen Pelaporan
@endsection

@section('container')
    <div class="form-group">
        <label for="service" class="form-label">Layanan</label>
        <select name="service" id="service" class="form-control">
            <option value="1">Penelitian</option>
            <option value="2">Permintaan Data</option>
            <option value="3">Peminjaman Sarana dan Prasarana</option>
            <option value="4">Praktikum</option>
        </select>
    </div>
    <div class="form-group">
        <label for="service" class="form-label">Layanan</label>
        <select name="service" id="service" class="form-control">
            <option value="1">Penelitian</option>
            <option value="2">Permintaan Data</option>
            <option value="3">Peminjaman Sarana dan Prasarana</option>
            <option value="4">Praktikum</option>
        </select>
    </div>
@endsection
