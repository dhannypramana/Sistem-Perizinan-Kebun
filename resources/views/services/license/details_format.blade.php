@extends('services.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/license_generator.css') }}">
@endsection

@section('container')
    <h2>{{ $data->format_title }}</h2>
    <hr class="divider rounded">

    <div class="box mt-3">
        <form id="templateForm" onsubmit="submitTemplateForm(event)">
            @csrf
            <div class="head">
                <h4>Kop Surat</h4>
                <hr class="divider rounded">
                @if ($data->letterhead)
                    <img src="{{ asset('/storage/image/' . $data->letterhead->letterhead) }}" alt="Kop Surat" class="kop">
                @else
                    <div class="nokop">Belum Ada Kop Surat</div>
                @endif

                <div class="form-row mt-4 d-flex justify-content-between align-items-center">
                    @if ($letterheads->isNotEmpty())
                        <div class="form-group col-md-5">
                            <label>Pilih Kop</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-custom dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($letterheads as $l)
                                        <a class="dropdown-item"
                                            onclick="updateImages(event, '{{ $data->id }}', '{{ $l->id }}', 'letterhead')">
                                            <div class="image-wrapper">
                                                <img src="{{ asset('/storage/image/' . $l->letterhead) }}" alt="Kop"
                                                    class="select-kop">
                                                <a onclick="deleteImages(event, '{{ $l->id }}', 'letterhead')"
                                                    class="btn-select btn btn-danger">
                                                    <img src="{{ asset('assets/images/svg/delete.svg') }}" alt="delete">
                                                </a>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="fst-italic fw-lighter">Atau</span>
                        </div>
                    @endif
                    <div class="form-group col-md-5">
                        <label for="letterhead" class="form-label">Upload Kop Baru</label>
                        <div class="custom-file">
                            <input type="file" name="letterhead" class="custom-file-input" id="letterhead">
                            <label class="custom-file-label" for="letterhead">Choose file</label>
                        </div>
                        <span class="text-danger fst-italic fw-lighter error-text letterhead_error"></span>
                    </div>
                </div>

                <hr>

                <h4>Tanda Tangan Surat</h4>
                <hr class="divider rounded">
                @if ($data->signature)
                    <img src="{{ asset('/storage/image/' . $data->signature->signature) }}" alt="Tanda Tangan Surat"
                        class="ttd">
                @else
                    <div class="nokop">Belum Ada Tanda Tangan Surat</div>
                @endif

                <div class="form-row mt-4 d-flex justify-content-between align-items-center">
                    @if ($signatures->isNotEmpty())
                        <div class="form-group col-md-5">
                            <label>Pilih Tanda Tangan</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-custom dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($signatures as $s)
                                        <a class="dropdown-item dropdown-item-license"
                                            onclick="updateImages(event, '{{ $data->id }}', '{{ $s->id }}', 'signature')">
                                            <div class="image-wrapper">
                                                <img src="{{ asset('/storage/image/' . $s->signature) }}" alt="Signature"
                                                    class="select-kop border">
                                                <a onclick="deleteImages(event, '{{ $s->id }}', 'signature')"
                                                    class="btn-select btn btn-danger">
                                                    <img src="{{ asset('assets/images/svg/delete.svg') }}" alt="delete">
                                                </a>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="fst-italic fw-lighter">Atau</span>
                        </div>
                    @endif
                    <div class="form-group col-md-5">
                        <label for="signature" class="form-label">Upload Tanda Tangan Baru</label>
                        <div class="custom-file">
                            <input type="file" name="signature" class="custom-file-input" id="signature">
                            <label class="custom-file-label" for="signature">Choose file</label>
                        </div>
                        <span class="text-danger fst-italic fw-lighter error-text signature_error"></span>
                    </div>
                </div>
            </div>

            <hr>

            <div class="body mt-3">
                <h4>Isi Surat</h4>
                <hr class="divider rounded">
                <div class="form-group">
                    <label for="title">Judul Surat</label>
                    <input type="text" name="title" class="form-control" id="title"
                        placeholder="Masukkan Judul Surat" placeholder="Masukkan Judul Surat" required
                        value="{{ $data->title }}">
                </div>

                <div class="form-group mt-3">
                    <label for="signed">Yang bertanda tangan</label>
                    <input type="text" name="signed" class="form-control" id="signed"
                        placeholder="Masukkan yang bertanda tangan" required value="{{ $data->signed }}">
                </div>

                <div class="user_info">
                    <h4 class="mt-4">Informasi Pengaju</h4>
                    <button id="addUserInfo" type="button"
                        class="btn btn-sm btn-info mt-3 ml-auto d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/plus.svg') }}" class="mr-1" style="height: 16px;">
                        <span>Tambah Informasi Pengaju</span>
                    </button>
                    @if ($user_info->isNotEmpty())
                        <table class="table table-bordered mt-3 text-center">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_info as $ui)
                                    <tr>
                                        <td>
                                            <span>
                                                {{ ucfirst(trans($ui->info_type)) }}
                                            </span>
                                            <span> - </span>
                                            <span>
                                                {{ $ui->type_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <img class="btn dropdown-toggle"data-toggle="dropdown"
                                                    src="{{ asset('/assets/images/svg/gear.svg') }}">
                                                <span class="caret"></span>
                                                </img>
                                                <ul class="dropdown-menu">
                                                    <li onclick="deleteUserInfo(event, '{{ $ui->id }}')"
                                                        style="cursor: pointer !important;">
                                                        <div class="dropdown-item">
                                                            <img src="{{ asset('assets/images/svg/delete.svg') }}"
                                                                class="mr-1">
                                                            <span
                                                                style="border: none; background: none; padding: 0; cursor: pointer;">
                                                                Hapus
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="research_info">
                    <h4 class="mt-4">Informasi Pengajuan</h4>
                    <button id="addServiceInfo" type="button"
                        class="btn btn-sm btn-info mt-3 ml-auto d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/plus.svg') }}" class="mr-1" style="height: 16px;">
                        <span>Tambah Informasi Pengajuan</span>
                    </button>
                    @if ($service_info->isNotEmpty())
                        <table class="table table-bordered mt-3 text-center">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service_info as $si)
                                    <tr>
                                        <td>
                                            <span>
                                                @if ($si->info_type == 'research')
                                                    Penelitian
                                                @elseif ($si->info_type == 'data_request')
                                                    Permintaan Data
                                                @elseif ($si->info_type == 'loan')
                                                    Peminjaman
                                                @else
                                                    Praktikum
                                                @endif
                                            </span>
                                            <span> - </span>
                                            <span>
                                                {{ $si->type_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <img class="btn dropdown-toggle"data-toggle="dropdown"
                                                    src="{{ asset('/assets/images/svg/gear.svg') }}">
                                                <span class="caret"></span>
                                                </img>
                                                <ul class="dropdown-menu">
                                                    <li onclick="deleteServiceInfo(event, '{{ $si->id }}')"
                                                        style="cursor: pointer !important;">
                                                        <div class="dropdown-item">
                                                            <img src="{{ asset('assets/images/svg/delete.svg') }}"
                                                                class="mr-1">
                                                            <span
                                                                style="border: none; background: none; padding: 0; cursor: pointer;">
                                                                Hapus
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <input type="text" name="license_format_id" class="form-control" value="{{ $data->id }}"
                style="display:none;">
            <button type="submit" class="btn btn-primary mt-3">
                <img src="{{ asset('assets/images/svg/save.svg') }}" class="mr-1">
                <span>Simpan Format</span>
            </button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#addServiceInfo').click(addServiceInfo);
            $('#addUserInfo').click(addUserInfo);
        });

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
                                window.location.href =
                                    '/admin/template/details/{{ $data->id }}';
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
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
                                    window.location.href =
                                        '/admin/template/details/{{ $data->id }}';
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
                                window.location.href =
                                    '/admin/template/details/{{ $data->id }}';
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
                                    window.location.href =
                                        '/admin/template/details/{{ $data->id }}';
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

        const deleteImages = (e, license_type_id, type) => {
            e.preventDefault();

            let url = '';

            if (type == 'letterhead') {
                url = "{{ route('delete_kop') }}"
            } else if (type == 'signature') {
                url = "{{ route('delete_signature') }}"
            }

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "kamu yakin untuk nenghapus gambar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus Sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: {
                            license_type_id: license_type_id,
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
                                    showCancelButton: true,
                                }).then(() => {
                                    window.location.href =
                                        '/admin/template/details/{{ $data->id }}';
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

        const updateImages = (e, license_format_id, license_type_id, type) => {
            e.preventDefault();

            let url = '';

            if (type == 'letterhead') {
                url = "{{ route('update_kop') }}"
            } else if (type == 'signature') {
                url = "{{ route('update_signature') }}"
            }

            $.ajax({
                url: url,
                type: "POST",
                enctype: 'multipart/form-data',
                data: {
                    license_format_id: license_format_id,
                    license_type_id: license_type_id,
                },
                dataType: 'json',
                beforeSend: function() {
                    onLoading();
                },
                success: function(data) {
                    window.location.href =
                        '/admin/template/details/{{ $data->id }}';
                },
                error: function(data) {
                    console.log(data.responseJSON.message);
                }
            });
        };

        const submitTemplateForm = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Pastikan Data Yang Kamu Masukkan Sudah Benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit Sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('#templateForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "{{ route('saveTemplate') }}",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        dataType: 'json',
                        beforeSend: function() {
                            $(document).find('span.error-text').text('');
                            onLoading();
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terdapat Kesalahan!',
                                    text: 'Periksa Kembali Form Kamu!',
                                }).then(() => {
                                    $.each(data.errors, function(prefix,
                                        val) {
                                        $('span.' + prefix +
                                            '_error').text(
                                            val[0]);
                                    });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href =
                                        '/admin/template/details/{{ $data->id }}';
                                });
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            })
        };
    </script>
@endsection
