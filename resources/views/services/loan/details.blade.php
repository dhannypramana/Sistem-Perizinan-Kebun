@extends('services.layouts.index')

@section('container')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header pt-4 px-4">
            <div class="items">
                <h5>No. Izin</h5>
                <p>{{ $loan->license_number }}</p>
            </div>
            <div class="items">
                <h5>Status Pengajuan</h5>
                <p>
                    @if ($loan->status == 0)
                        Menunggu Konfirmasi
                    @elseif ($loan->status == 1)
                        Disetujui
                    @elseif ($loan->status == 2)
                        Ditolak
                    @endif
                </p>
            </div>
        </div>
        <div class="card-body">
            <h4>Informasi Pengaju</h4>
            <div class="border rounded mt-3 mb-5">
                <table class="table text-left">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $loan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $loan->user->address }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $loan->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ \App\Helpers\Helpers::isStudent($loan->user->email) ? 'Mahasiswa' : 'Dosen' }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>{{ $loan->user->academic_program }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan / Fakultas</th>
                        <td>{{ $loan->user->major }}</td>
                    </tr>
                    <tr>
                        <th>{{ \App\Helpers\Helpers::isStudent($loan->user->email) ? 'NIM' : 'NIP' }}</th>
                        <td>{{ $loan->user->student_number }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $loan->user->phone_number }}</td>
                    </tr>
                </table>
            </div>

            <h4>Informasi Pengajuan</h4>
            <div class="border rounded mt-3">
                <table class="table text-left">
                    @if ($loan->admin_message)
                        <tr>
                            <th class="text-danger">Alasan Penolakan</th>
                            <td class="text-danger">{{ $loan->admin_message }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>
                            {{ $loan->created_at->format('j F Y, H:i a') }}
                        </td>
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
                    @if ($loan->reply !== null)
                        <tr>
                            <th>Surat Balasan</th>
                            <td>
                                <a target="__blank"
                                    href="{{ route('reply_license', ['license_number' => $loan->license_number]) }}">Lihat
                                    Surat</a>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin')
                <div class="btn-group mt-3">
                    @if (!$loan->is_reviewed)
                        <button class="btn btn-primary rounded" onclick="accept()">Konfirmasi</button>
                    @endif
                </div>
            @endif
        </div>
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
                                window.location.href = '/admin/loan/check';
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

        const accept = (e) => {
            Swal.fire({
                title: 'Konfirmasi Ajuan?',
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
                        `/admin/template/final-template/${result.value.license_format}/{{ $loan->user->id }}/{{ $loan->license_number }}`;
                }
            });
        };
    </script>
@endsection
