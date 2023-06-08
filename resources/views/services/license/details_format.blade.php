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
                        <label for="kop">Upload Kop Baru</label>
                        <input type="file" name="letterhead" class="form-control-file mt-1" id="letterhead">
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
                                                <img src="{{ asset('/storage/image/' . $s->signature) }}" alt="Kop"
                                                    class="select-kop">
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
                        <label for="kop">Upload Tanda Tangan Baru</label>
                        <input type="file" name="signature" class="form-control-file mt-1" id="signature">
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
                    <label for="footnote">Footnote</label>
                    <input type="text" name="footnote" class="form-control" id="footnote"
                        placeholder="Masukkan Footnote" placeholder="Masukkan Footnote" required
                        value="{{ $data->footnote }}">
                </div>

                {{-- <div class="user_info">
                    <h4 class="mt-4">Informasi Pengaju</h4>
                    <table class="table table-bordered mt-3 text-center">
                        <thead>
                            <tr>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>
                                    <input type="checkbox" value="name" name="type[]">
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>
                                    <input type="checkbox" value="alamat" name="type[]">
                                </td>
                            </tr>
                            <tr>
                                <td>Prodi</td>
                                <td>
                                    <input type="checkbox" value="prodi" name="type[]">
                                </td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>
                                    <input type="checkbox" value="nim" name="type[]">
                                </td>
                            </tr>
                            <tr>
                                <td>No Telefon</td>
                                <td>
                                    <input type="checkbox" value="no_telfon" name="type[]">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                {{-- <div class="research_info">
                    <h4 class="mt-4">Informasi Pengajuan</h4>
                    <table class="table table-bordered mt-3 text-center">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lokasi Penelitian</td>
                                <td>Penelitian - Lokasi</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Personil</td>
                                <td>Penelitian - Jumlah</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Judul Penelitian</td>
                                <td>Penelitian - Judul</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Waktu Mulai</td>
                                <td>Penelitian - Mulai</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Waktu Berakhir</td>
                                <td>Penelitian - Berakhir</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Fasilitas</td>
                                <td>Penelitian - Fasilitas</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Dosen Pembimbing Penelitian</td>
                                <td>Penelitian - Dosen Penelitian</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Dosen Pembimbing Akademik</td>
                                <td>Penelitian - Dosen Akademik</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Pengajuan</td>
                                <td>Penelitian - Status</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
            </div>
            <input type="text" name="license_format_id" class="form-control" value="{{ $data->id }}"
                style="display:none;">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
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
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terdapat Kesalahan!',
                                    text: 'Periksa Kembali Form Kamu!',
                                }).then(() => {
                                    $.each(data.errors, function(prefix, val) {
                                        $('span.' + prefix + '_error').text(
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
