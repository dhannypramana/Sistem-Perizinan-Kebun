@extends('services.layouts.index')

@section('container')
    <div class="card">
        <div class="card-header justify-content-between d-flex pt-4 px-4">
            <div class="items">
                <h5>No. Izin</h5>
                <p>{{ $data_request->license_number }}</p>
            </div>
            <div class="items">
                <h5>Tanggal Pengajuan</h5>
                <p>{{ $data_request->created_at->format('j F Y, H:i a') }}</p>
            </div>
            <div class="items">
                <h5>Status Pengajuan</h5>
                <p>{{ $data_request->status }}</p>
            </div>
        </div>
        <div class="card-body">
            <div class="border d-flex rounded">
                <table class="table text-left">
                    @if ($data_request->admin_message)
                        <tr>
                            <th class="text-danger">Pesan Admin</th>
                            <td class="text-danger">{{ $data_request->admin_message }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Nama</th>
                        <td>{{ $data_request->user->name }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $data_request->user->student_number }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $data_request->user->address }}</td>
                    </tr>
                    <tr>
                        <th>No. Telefon</th>
                        <td>{{ $data_request->user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>{{ $data_request->user->academic_program }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Data</th>
                        <td>{{ $data_request->category }}</td>
                    </tr>
                    <tr>
                        <th>Data yang Diajukan</th>
                        <td>{{ $data_request->title }}</td>
                    </tr>
                    <tr>
                        <th>Keperluan Data</th>
                        <td>{{ $data_request->purpose }}</td>
                    </tr>
                    <tr>
                        <th>Asal Instansi</th>
                        <td>{{ $data_request->agency }}</td>
                    </tr>
                    <tr>
                        <th>Surat Pengantar Instansi</th>
                        <td>
                            <a target="__blank"
                                href="{{ route('agency_license', ['license_number' => $data_request->license_number]) }}">Lihat
                                Surat</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <a href="javascript:history.back()" class="btn btn-secondary my-3">
        <img src="{{ asset('assets/images/svg/arrow_left.svg') }}">
        <span>Kembali</span>
    </a>
@endsection
