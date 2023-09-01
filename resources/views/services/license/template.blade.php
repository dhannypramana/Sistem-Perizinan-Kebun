@extends('services.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/template.css') }}">
@endsection

@section('container')
    <div class="container border p-0 mb-5">
        {{-- Letterhead --}}
        <div class="letterhead">
            @if ($letterheads->isEmpty())
                <div class="border py-3 text-center bg-white">
                    Belum ada Kop Surat
                </div>
            @else
                <img src="{{ asset('/storage/image/' . $letterheads[0]->letterhead) }}" alt="letterhead" class="w-100">
            @endif
        </div>

        <div class="license-wrapper p-4">
            <div class="license-head d-flex justify-content-between ml-auto mr-auto">
                <div class="meta">
                    <table>
                        <tr>
                            <td>
                                <span>Nomor</span>
                            </td>
                            <td>
                                <span class="ml-2 ">: </span>
                                <span class="ml-2">006/IT9.4.5/LL/2023</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Lampiran</span>
                            </td>
                            <td>
                                <span class="ml-2">: </span>
                                <span class="ml-2">-</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>
                                <span class="ml-2">: </span>
                                <span class="ml-2">
                                    @if ($data->title)
                                        {{ $data->title }}
                                    @else
                                        <span class="text-danger">Belum Ada Perihal</span>
                                    @endif
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="date">
                    <p>{{ $data->updated_at->format('j F Y') }}</p>
                </div>
            </div>

            <div class="license-receiver my-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        <span>Yth. Ketua <span class="text-capitalize">{{ $service_data['agency'] }}</span> </span> <br>
                        <span>Institut Teknologi Sumatera</span> <br>
                        <span>di</span> <br>
                        <span>Kampus ITERA</span>
                    </div>
                </div>
            </div>

            <div class="license-body">
                @if ($body === null)
                    <textarea name="body" id="body" rows="5" class="form-control"></textarea>
                    <button type="button" class="btn btn-sm btn-info ml-auto d-flex my-3"
                        onclick="submitBody()">Submit</button>
                @else
                    <div class="row">
                        <div class="col">
                            <px>{{ $body->body }}</px>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-facebook border" onclick="editModeBody()">
                                <img src="{{ asset('/assets/images/svg/edit.svg') }}" alt="editIcon">
                            </button>
                        </div>
                    </div>
                @endif

                <div class="row mt-5">
                    <div class="col-md-3">
                        <h5 class="font-weight-bold m-0 mr-3">Informasi Pengaju</h5>
                    </div>
                    <div class="col-md-9">
                        <button id="addUserInfo" type="button" class="btn btn-sm btn-info">
                            <img src="{{ asset('assets/images/svg/plus.svg') }}" style="height: 16px;">
                            <span>Tambah Informasi Pengaju</span>
                        </button>
                    </div>
                </div>

                @if ($user_info->isNotEmpty())
                    @foreach ($user_info as $ui)
                        <div class="row my-2 align-items-center">
                            <div class="col-md-4">
                                <p class="text-capitalize m-0">{{ $ui->type_name }}</p>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-capitalize m-0">{{ $user[$ui->type] }}</p>
                                    <button class="btn btn-facebook border ml-5"
                                        onclick="deleteUserInfo(event, '{{ $ui->id }}')"
                                        style="cursor: pointer !important;">
                                        <img src="{{ asset('/assets/images/svg/delete.svg') }}" alt="deleteIcon">
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="mb-5">Belum ada Informasi Pengaju</p>
                @endif

                <div class="row mt-4">
                    <div class="col-md-3">
                        <h5 class="font-weight-bold m-0 mr-3">Informasi Pengajuan</h5>
                    </div>
                    <div class="col-md-9">
                        <button id="addServiceInfo" type="button" class="btn btn-sm btn-info">
                            <img src="{{ asset('assets/images/svg/plus.svg') }}" style="height: 16px;">
                            <span>Tambah Informasi Pengajuan</span>
                        </button>
                    </div>
                </div>
                @if ($service_info->isNotEmpty())
                    @foreach ($service_info as $si)
                        <div class="row my-2 align-items-center">
                            <div class="col-md-4">
                                <p class="text-capitalize m-0">{{ $si->type_name }}</p>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-capitalize m-0">{{ $service_data[$si->type] }}</p>
                                    <button class="btn btn-facebook border ml-5"
                                        onclick="deleteServiceInfo(event, '{{ $si->id }}')"
                                        style="cursor: pointer !important;">
                                        <img src="{{ asset('/assets/images/svg/delete.svg') }}" alt="deleteIcon">
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="mb-5">Belum ada Informasi Pengajuan</p>
                @endif
                <p class="mt-4">Adapun dosen penanggung jawab kegiatan dapat melakukan koordinasi lebih lanjut dengan UPT
                    KFS berkaitan
                    dengan segala aktivitas kegiatan yang ada di Kebun Raya ITERA. Narahubung UPT KFS a.n. Eryka Merdiana,
                    S.P. (082181021850).
                    Selama pelaksanaan kegiatan, mohon tetap melaksanakan protokol kesehatan sebagaimana yang telah
                    ditetapkan di lingkungan kampus ITERA dan menjaga kebersihan serta keamanan. Demikian surat ini kami
                    sampaikan. Atas kerjasamanya kami ucapkan terima kasih</p>
                {{-- <button type="button" class="btn btn-sm btn-info ml-auto d-flex my-3"
                    onclick="editTextArea('footer')">Edit</button> --}}
            </div>

            <div class="license-footer d-flex flex-column align-items-end mt-4">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="signature mt-3">
                        @if ($signatures->isEmpty())
                            <div class="border rounded bg-white p-3">
                                Belum ada TTD
                            </div>
                        @else
                            <img src="{{ asset('/storage/image/' . $signatures[0]->signature) }}" alt="letterhead"
                                width="100">
                        @endif
                    </div>
                    <div class="mt-3">
                        @if (!$data->signed)
                            Belum Ada Tertanda
                        @else
                            <div>{{ $data->signed }}</div>
                        @endif
                        @if (!$data->nip)
                            <div>
                                Belum Ada NIP Tertanda
                            </div>
                        @else
                            <div>NIP. {{ $data->nip }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 p-0">
        <form onsubmit="accept(event)" id="acceptForm" method="POST">
            @csrf
            <input type="hidden" name="license_number" value="{{ $license_number }}">
            <button type="submit" class="btn btn-primary">
                <img src="{{ asset('/assets/images/svg/document.svg') }}" alt="documentIcon">
                <span>Finalisasi Persetujuan</span>
            </button>
        </form>
    </div>
    {{-- <div class="signature">
            <img src="{{ asset('/storage/image/' . $signatures[0]->signature) }}" alt="letterhead" width="500">
        </div>
        <p>Judul Format : {{ $data->format_title }}</p>
        <p>Judul Surat : {{ $data->title }}</p>
        <p>Footnote Surat : {{ $data->footnote }}</p>

        @if ($user_info->isNotEmpty())
            <h5>User Info</h5>
            @foreach ($user_info as $ui)
                <p>{{ $ui->info_type }} - {{ $ui->type_name }} - {{ $user[$ui->type] }}</p>
            @endforeach
        @endif

        @if ($service_info->isNotEmpty())
            <h5>Service Info</h5>
            @foreach ($service_info as $si)
                <p>{{ $si->info_type }} - {{ $si->type_name }} -
                    @if ($si->info_type == 'practicum')
                        @foreach ($service_data as $sd)
                            <p>
                                {{ $loop->index + 1 }}. {{ $sd[$si->type] }}
                            </p>
                            <p>Status Pengajuan : {{ $sd->status }}</p>
                        @endforeach
                    @else
                        {{ $service_data[$si->type] }}
                    @endif
                </p>
            @endforeach
        @endif --}}

    {{-- <pre>{{ $service_data }}</pre> --}}
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#addServiceInfo').click(addServiceInfo);
            $('#addUserInfo').click(addUserInfo);
        });

        const editModeBody = () => {
            const bodyData = @json($body);

            Swal.fire({
                title: 'Update Body',
                html: `
                    <form>
                        <textarea name="edit" id="edit" rows="5" class="form-control"></textarea>
                    </form>`,
                width: '1000px',
                focusConfirm: false,
                confirmButtonText: 'Edit',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                didOpen: () => {
                    const edit = $('#edit');

                    if (bodyData !== null) {
                        edit.val(bodyData.body);
                    }
                },
                preConfirm: () => {
                    const updatedBody = $('#edit').val();

                    if (!updatedBody) {
                        return Swal.showValidationMessage('Field is Required')
                    }

                    return {
                        id: bodyData.id,
                        updatedBody
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        id,
                        updatedBody,
                    } = result.value;

                    $.ajax({
                        url: "{{ route('update-license-body') }}",
                        type: "POST",
                        data: {
                            id,
                            body: updatedBody
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });
        }

        const submitBody = () => {
            const body = $('#body').val()
            const license_number = '{{ $license_number }}';
            const license_format_id = '{{ $data->id }}';

            $.ajax({
                url: "{{ route('create-license-body') }}",
                type: "POST",
                data: {
                    body,
                    license_number,
                    license_format_id
                },
                dataType: 'json',
                beforeSend: function() {
                    onLoading();
                },
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: "Error!",
                            text: data.err,
                            icon: 'error',
                        });
                    } else {
                        Swal.fire({
                            title: "Success!",
                            text: data.success,
                            icon: 'success',
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(data) {
                    console.log(data.responseJSON.message);
                }
            });

            console.log(body);
            console.log(license_number);
            console.log(license_format_id);
        }

        const deleteServiceInfo = (e, id) => {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "kamu yakin untuk menghapus Informasi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus Sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-license-user') }}",
                        type: "POST",
                        data: {
                            license_format_details_id: id,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                Swal.fire({
                                    title: "Success!",
                                    text: data.success,
                                    icon: 'success',
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });
        };

        const addServiceInfo = () => {
            Swal.fire({
                title: 'Tambahkan Informasi',
                html: `<div class="form-group col-md-12 text-left">
                <label for="select1">Layanan</label>
                <select name="select1" id="select1" class="form-control" required>
                    <option selected disabled>Choose...</option>
                    <option value="research">Penelitian</option>
                    <option value="data_request">Permintaan Data</option>
                    <option value="loan">Peminjaman</option>
                    <option value="practicum">Praktikum</option>
                </select>
                <br>
                <label for="select2">Kategori:</label>
                <select name="select2" id="select2" class="form-control" required>
                </select>
                </div>`,
                focusConfirm: false,
                confirmButtonText: 'Tambah',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                preConfirm: () => {
                    const service = $('#select1').val();
                    const type = $('#select2').val();
                    const type_name = $('#select2 option:selected').text();

                    if (!type) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        return {
                            service,
                            type,
                            type_name,
                        };
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        service,
                        type,
                        type_name,
                    } = result.value;

                    $.ajax({
                        url: "{{ route('post-license-service') }}",
                        type: "POST",
                        data: {
                            license_format_id: '{{ $data->id }}',
                            service,
                            type,
                            type_name
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });

            $('#select1').on('change', () => {
                let type = $('#select1').val();

                let url = "{{ route('get-license-service', ['type' => ':type']) }}";
                url = url.replace(/:type/g, type);

                $.get(url).done((data) => {
                    let services = $.map(data, (option) => option);
                    services.splice(0, 1);

                    $('#select2').empty();
                    $.each(services, (index, option) => {
                        const optionElement = $('<option></option>')
                            .val(option.type)
                            .text(option.type_name);
                        $('#select2').append(optionElement);
                    });
                });
            });
        };

        const deleteUserInfo = (e, id) => {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "kamu yakin untuk menghapus Informasi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus Sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-license-user') }}",
                        type: "POST",
                        data: {
                            license_format_details_id: id,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                Swal.fire({
                                    title: "Success!",
                                    text: data.success,
                                    icon: 'success',
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });
        };

        const addUserInfo = () => {
            Swal.fire({
                title: 'Tambahkan Informasi',
                html: `<div class="form-group col-md-12 text-left">
                <label for="select1" class="form-label">Data User</label>
                <select name="select1" id="select1" class="form-control" required>
                </select>
                </div>`,
                focusConfirm: false,
                confirmButtonText: 'Tambah',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                didOpen: () => {
                    let select1 = $('#select1');
                    let url = "{{ route('get-license-user') }}";

                    $.get(url).done((response) => {
                        $.each(response.data, (index, option) => {
                            const optionElement = $('<option></option>')
                                .val(option.type)
                                .text(option.type_name);
                            select1.append(optionElement);
                        });
                    });
                },
                preConfirm: () => {
                    const type = $('#select1').val();
                    const type_name = $('#select1 option:selected').text();

                    if (!type) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        return {
                            type,
                            type_name,
                        };
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        type,
                        type_name
                    } = result.value;

                    $.ajax({
                        url: "{{ route('post-license-user') }}",
                        type: "POST",
                        data: {
                            license_format_id: '{{ $data->id }}',
                            info_type: 'user',
                            type,
                            type_name,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            // onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                location.reload();
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });
        };

        const editTextArea = (type) => {
            let textarea = null

            if (type === 'body') {
                textarea = $('#textAreaBody')
            } else {
                textarea = $('#textAreaFooter')
            }

            textarea.prop('disabled', !textarea.prop('disabled'));
        }

        const accept = (e) => {
            e.preventDefault();

            let license_number = $('input[name=license_number]').val();

            $.ajax({
                url: "{{ route('accept') }}",
                type: "POST",
                data: {
                    license_number: license_number,
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = `/admin/loan/check/${license_number}`
                    });
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        confirmButtonText: 'OK'
                    });
                },
            });
        }
    </script>
@endsection
