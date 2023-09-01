@extends('services.layouts.index')

@section('container')
    <div class="card">
        <div class="card-header justify-content-between d-flex pt-4 px-4">
            <div class="items">
                <h5>No. Izin</h5>
                <p id="license_number">{{ $research->license_number }}</p>
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

            @if (auth()->user()->is_admin == 1)
                <div class="btn-group mt-3">
                    @if (!$research->is_reviewed)
                        <button class="btn btn-primary rounded" onclick="accept()">Setujui</button>
                        {{-- <form onsubmit="accept(event)" id="acceptForm" method="POST" action="{{ route('accept') }}">
                            @csrf
                            <input type="hidden" name="license_number" value="{{ $research->license_number }}">
                            <button type="submit" class="btn btn-primary">Setujui</button>
                        </form>

                        <form onsubmit="reject(event)" class="ml-2" id="rejectForm" method="POST"
                            action="{{ route('reject') }}">
                            @csrf
                            <input type="hidden" name="license_number" value="{{ $research->license_number }}">
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </form> --}}
                    @endif
                </div>
            @endif
        </div>
    </div>

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
                                window.location.href = '/admin/research/check';
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
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        };

        const accept = () => {
            // let license_number = $('input[name=license_number]').val();

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

                    if (!license_format_select) return Swal.showValidationMessage('Field is Required')

                    return {
                        license_format: createSlug(license_format_select)
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        `/admin/template/final-template/${result.value.license_format}/{{ $research->user->id }}/{{ $research->license_number }}`;
                }
            });
        };
    </script>
@endsection
