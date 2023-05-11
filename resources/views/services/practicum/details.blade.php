@extends('services.layouts.index')

<?php
use Carbon\Carbon;
?>

@section('container')
    @forelse ($practicum as $p)
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center p-4">
                <div class="items">
                    <h5>No. Izin</h5>
                    <p>{{ $p->license_number }}</p>
                </div>
                <div class="items">
                    <h5>Tanggal Pengajuan</h5>
                    <p>{{ $p->created_at->format('j F Y, H:i a') }}</p>
                </div>
                <div class="items">
                    <h5>Status Pengajuan</h5>
                    <p>{{ $p->status }}</p>
                </div>
            </div>
            <div class="card-body">
                <h4>Mata Kuliah #{{ $loop->iteration }}</h4>
                <div class="border d-flex rounded mt-4">
                    <table class="table bordered text-left">
                        @if ($p->admin_message)
                            <tr>
                                <th>Alasan Penoakan</th>
                                <td>{{ $p->admin_message }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Lokasi Praktikum</th>
                            <td>{{ $p->location }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Mahasiswa</th>
                            <td>{{ $p->personnel }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Penanggung Jawab Praktikum</th>
                            <td>{{ $p->practicum_supervisor }}</td>
                        </tr>
                        <tr>
                            <th>Nama Asisten</th>
                            <td>{{ $p->assistant }}</td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah</th>
                            <td>{{ $p->subject }}</td>
                        </tr>
                        <tr>
                            <th>Penanggung Jawab Kelas</th>
                            <td>{{ $p->class_supervisor }}</td>
                        </tr>
                        <tr>
                            <th>Fasilitas yang Digunakan</th>
                            <td>{{ $p->facility }}</td>
                        </tr>
                        <tr>
                            <th>Waktu praktikum</th>
                            @php
                                $toDate = Carbon::parse($p->start_time);
                                $fromDate = Carbon::parse($p->end_time);
                                
                                $practicum_time = $toDate->diffInDays($fromDate);
                            @endphp
                            <td>{{ $practicum_time }} Hari<br> Terhitung Sejak
                                @php
                                    $day = date('d', strtotime($p->start_time));
                                    $month = date('M', strtotime($p->start_time));
                                    $year = date('Y', strtotime($p->start_time));
                                @endphp
                                {{ $day }} {{ $month }} {{ $year }} sampai
                                @php
                                    $day = date('d', strtotime($p->end_time));
                                    $month = date('M', strtotime($p->end_time));
                                    $year = date('Y', strtotime($p->end_time));
                                @endphp
                                {{ $day }} {{ $month }} {{ $year }}
                            </td>
                        </tr>
                        <tr>
                            <th>Surat Pengantar Instansi</th>
                            <td>
                                <a target="__blank"
                                    href="{{ route('agency_license', ['license_number' => $p->license_number]) }}">Lihat
                                    Surat</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @empty
    @endforelse

    <a href="javascript:history.back()" class="btn btn-secondary my-3">
        <img src="{{ asset('assets/images/svg/arrow_left.svg') }}">
        <span>Kembali</span>
    </a>
@endsection
