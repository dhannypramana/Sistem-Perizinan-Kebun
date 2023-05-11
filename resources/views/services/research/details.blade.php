@extends('services.layouts.index')

@section('container')
    <div class="card">
        <div class="card-header justify-content-between d-flex pt-4 px-4">
            <div class="items">
                <h5>No. Izin</h5>
                <p>{{ $research->license_number }}</p>
            </div>
            <div class="items">
                <h5>Tanggal Pengajuan</h5>
                <p>{{ $research->created_at->format('j F Y, H:i a') }}</p>
            </div>
            <div class="items">
                <h5>Status Pengajuan</h5>
                <p>{{ $research->status }}</p>
            </div>
        </div>
        <div class="card-body">
            <div class="border d-flex rounded">
                <table class="table text-left">
                    @if ($research->admin_message)
                        <tr>
                            <th class="text-danger">Pesan Admin</th>
                            <td class="text-danger">{{ $research->admin_message }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Nama</th>
                        <td>{{ $research->user->name }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $research->user->student_number }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $research->user->address }}</td>
                    </tr>
                    <tr>
                        <th>No. Telefon</th>
                        <td>{{ $research->user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>{{ $research->user->academic_program }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi Penelitian</th>
                        <td>{{ $research->location }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Personil</th>
                        <td>{{ $research->personnel }}</td>
                    </tr>
                    <tr>
                        <th>Judul Penelitian</th>
                        <td>{{ $research->title }}</td>
                    </tr>
                    <tr>
                        <th>Waktu penelitian</th>
                        <td>{{ $research_time }} Hari<br> Terhitung Sejak
                            @php
                                $day = date('d', strtotime($research->start_time));
                                $month = date('M', strtotime($research->start_time));
                                $year = date('Y', strtotime($research->start_time));
                            @endphp
                            {{ $day }} {{ $month }} {{ $year }} sampai
                            @php
                                $day = date('d', strtotime($research->end_time));
                                $month = date('M', strtotime($research->end_time));
                                $year = date('Y', strtotime($research->end_time));
                            @endphp
                            {{ $day }} {{ $month }} {{ $year }}
                        </td>
                    </tr>
                    <tr>
                        <th>Fasilitas yang Digunakan</th>
                        <td>{{ $research->facility }}</td>
                    </tr>
                    <tr>
                        <th>Nama Dosen Pembimbing Penelitian</th>
                        <td>{{ $research->research_supervisor }}</td>
                    </tr>
                    <tr>
                        <th>Nama Dosen Pembimbing akademik</th>
                        <td>{{ $research->academic_supervisor }}</td>
                    </tr>
                    <tr>
                        <th>Surat Pengantar Instansi</th>
                        <td>
                            <a target="__blank"
                                href="{{ route('agency_license', ['license_number' => $research->license_number]) }}">Lihat
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
