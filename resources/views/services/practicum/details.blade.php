@extends('services.layouts.index')

<?php
use Carbon\Carbon;
?>

@section('container')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @forelse ($practicum as $p)
        <div class="card mt-3">
            @if ($loop->iteration == 1)
                <div class="card-header pt-4 px-4">
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
                        <p>
                            @if ($p->status == 0)
                                Menunggu Konfirmasi
                            @elseif ($p->status == 1)
                                Disetujui
                            @elseif ($p->status == 2)
                                Ditolak
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mx-4 mt-4 mb-3">
                    <div>
                        <h5 class="font-weight-bold">Surat Pengantar Instansi</h5>
                        <a target="__blank"
                            href="{{ route('agency_license', ['license_number' => $p->license_number]) }}">Lihat
                            Surat</a>
                    </div>
                    <div class="mt-3">
                        @if ($p->reply !== null)
                            <h5 class="font-weight-bold">Surat Balasan</h5>
                            <a target="__blank"
                                href="{{ route('reply_license', ['license_number' => $p->license_number]) }}">Lihat
                                Surat</a>
                            </tr>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card-body">
                <h4>Mata Kuliah #{{ $loop->iteration }}</h4>
                <div class="border d-flex rounded mt-4">
                    <table class="table bordered text-left">
                        @if ($p->admin_message)
                            <tr>
                                <th class="text-danger">Alasan Penolakan</th>
                                <td class="text-danger">{{ $p->admin_message }}</td>
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
                            <th>Jadwal Praktikum</th>
                            <td>
                                @php
                                    $day = date('d', strtotime($p->start_date));
                                    $month = date('M', strtotime($p->start_date));
                                    $year = date('Y', strtotime($p->start_date));
                                @endphp
                                @if ($p->end_date)
                                    @php
                                        $dayEnd = date('d', strtotime($p->end_date));
                                        $monthEnd = date('M', strtotime($p->end_date));
                                        $yearEnd = date('Y', strtotime($p->end_date));

                                        $endDate = Carbon::parse($p->end_date);
                                        $dayName = $endDate->format('l');
                                    @endphp
                                    {{ $day }} {{ $month }} {{ $year }}
                                    sampai {{ $dayEnd }} {{ $monthEnd }} {{ $yearEnd }} <br>

                                    Setiap {{ $dayName }}, {{ $p->start_time }} -
                                    {{ $p->end_time }}
                                @else
                                    {{ $day }} {{ $month }} {{ $year }}, {{ $p->start_time }} -
                                    {{ $p->end_time }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            @empty
    @endforelse
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin')
        <div class="btn-group mt-3">
            @if (!$practicum[0]->is_reviewed)
                <form onsubmit="accept(event)" id="acceptForm" method="POST" action="{{ route('accept') }}">
                    @csrf
                    <input type="hidden" name="license_number" value="{{ $practicum[0]->license_number }}">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            @endif
        </div>
    @endif
    </div>
@endsection

@section('script')
    <script>
        const reject = (e) => {
            e.preventDefault();

            let license_number = $('input[name=license_number]').val();

            Swal.fire({
                title: 'Alasan Penolakan',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Tolak',
                preConfirm: (admin_message) => {
                    if (!admin_message) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('reject') }}",
                            type: "POST",
                            data: {
                                license_number: license_number,
                                admin_message: admin_message
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/admin/practicum/check';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: xhr.responseJSON.message,
                                    confirmButtonText: 'OK'
                                });
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        };

        const accept = (e) => {
            e.preventDefault();

            let license_number = $('input[name=license_number]').val();

            Swal.fire({
                title: 'Setujui Ajuan?',
                icon: 'info',
                width: "800px",
                html: `
                    <div class="form-group text-left mb-2">
                        <label class="form-label">Format Surat Balasan</label>
                        <select name="license_format_select" id="license_format_select" class="form-control shadow-none">
                        </select>
                    </div>
                    `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Setujui Sekarang!',
                didOpen: () => {
                    let license_format_select = $('#license_format_select');
                    let url = "{{ route('get-license-formats') }}";

                    $.get(url).done((response) => {
                        $.each(response.data, (index, option) => {
                            const optionElement = $('<option></option>')
                                .val(option.id)
                                .text(option.format_title);
                            license_format_select.append(optionElement);
                        });
                    });
                },
                preConfirm: () => {
                    const license_format_select = $('#license_format_select')[0].value;

                    if (!license_format_select) return Swal.showValidationMessage(
                        `Field is Required or <a href="{{ route('template') }}" class="ml-1">Create a new one</a>`
                    )

                    return {
                        license_format: createSlug(license_format_select)
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        `/admin/template/final-template/${result.value.license_format}/{{ $practicum[0]->user->id }}/{{ $practicum[0]->license_number }}`;
                }
            });
        };
    </script>
@endsection
