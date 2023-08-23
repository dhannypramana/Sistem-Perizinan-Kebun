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

    @if (auth()->user()->is_admin == 1)
        <div class="btn-group mt-3">
            @if (!$practicum[0]->is_reviewed)
                <form onsubmit="accept(event)" id="acceptForm" method="POST" action="{{ route('accept') }}">
                    @csrf
                    <input type="hidden" name="license_number" value="{{ $practicum[0]->license_number }}">
                    <button type="submit" class="btn btn-primary">Setujui</button>
                </form>

                <form onsubmit="reject(event)" class="ml-2" id="rejectForm" method="POST"
                    action="{{ route('reject') }}">
                    @csrf
                    <input type="hidden" name="license_number" value="{{ $practicum[0]->license_number }}">
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            @endif
        </div>
    @endif

    <br>

    <a href="javascript:history.back()" class="btn btn-secondary my-3">
        <img src="{{ asset('assets/images/svg/arrow_left.svg') }}">
        <span>Kembali</span>
    </a>
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
                                .text(option.title);
                            license_format_select.append(optionElement);
                        });
                    });
                },
                preConfirm: () => {
                    const license_format_select = $('#license_format_select')[0].value;

                    if (!license_format_select) return Swal.showValidationMessage('Field is Required')

                    return {
                        license_format: createSlug(license_format_select)
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('accept') }}",
                        type: "POST",
                        data: {
                            license_number: license_number,
                            license_format: result.value.license_format,
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href =
                                    `/admin/template/final-template/${response.license_format}/{{ $practicum[0]->user->id }}/{{ $practicum[0]->license_number }}`
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message,
                                confirmButtonText: 'OK'
                            });
                        },
                    });
                }
            });
        };
    </script>
@endsection
