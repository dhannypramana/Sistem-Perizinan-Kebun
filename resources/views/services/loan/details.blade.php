@extends('services.layouts.index')

@section('container')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center pt-4 px-4">
            <div class="items">
                <h5>No. Izin</h5>
                <p>{{ $loan->no_izin }}</p>
            </div>
            <div class="items">
                <h5>Tanggal Pengajuan</h5>
                <p>{{ $loan->created_at->format('j F Y, H:i a') }}</p>
            </div>
            <div class="items">
                <h5>Status Pengajuan</h5>
                <p>{{ $loan->status }}</p>
            </div>
        </div>
        <div class="card-body">
            <div class="border d-flex rounded">
                <table class="table bordered text-left">
                    @if ($loan->admin_message)
                        <tr>
                            <th class="text-danger">Alasan Penolakan</th>
                            <td class="text-danger">{{ $loan->admin_message }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Nama</th>
                        <td>{{ $loan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $loan->user->student_number }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $loan->user->address }}</td>
                    </tr>
                    <tr>
                        <th>No. Telefon</th>
                        <td>{{ $loan->user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>{{ $loan->user->academic_program }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Peminjaman</th>
                        <td>{{ $loan->category }}</td>
                    </tr>
                    <tr>
                        <th>Sarana yang Dipinjam</th>
                        <td>{{ $loan->title }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Peminjaman</th>
                        <td>{{ $loan->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <td>{{ $loan->activity }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan Peminjaman</th>
                        <td>{{ $loan->purpose }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Peminjaman</th>
                        <td>{{ $loan_time }} Hari<br> Terhitung Sejak
                            @php
                                $day = date('d', strtotime($loan->start_time));
                                $month = date('M', strtotime($loan->start_time));
                                $year = date('Y', strtotime($loan->start_time));
                            @endphp
                            {{ $day }} {{ $month }} {{ $year }} sampai
                            @php
                                $day = date('d', strtotime($loan->end_time));
                                $month = date('M', strtotime($loan->end_time));
                                $year = date('Y', strtotime($loan->end_time));
                            @endphp
                            {{ $day }} {{ $month }} {{ $year }}
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Pengantar Instansi</th>
                        <td>
                            <a target="__blank"
                                href="{{ route('agency_license', ['license_number' => $loan->license_number]) }}">Lihat
                                Surat</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <a href="javascript:history.back()" class="btn btn-secondary mt-3">
        <img src="{{ asset('assets/images/svg/arrow_left.svg') }}">
        <span>Kembali</span>
    </a>
@endsection
