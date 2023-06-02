@extends('services.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/license_generator.css') }}">
@endsection

@section('container')
    <h2>{{ $data->format_title }}</h2>

    <form action="{{ route('insertTolol') }}" method="post">
        @csrf
        <div class="head">
            <h5>Kop Surat</h5>
            <img src="{{ asset($data->letterhead) }}" alt="Kop Surat" class="kop">
        </div>

        <div class="body">
            <div class="form-group mt-3">
                <label for="title">Judul Surat</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Judul Surat" required
                    value="{{ $data->title }}">
            </div>

            <div class="form-group mt-3">
                <label for="footnote">Footnote</label>
                <input type="text" name="footnote" class="form-control" id="footnote" placeholder="Footnote" required
                    value="{{ $data->footnote }}">
            </div>

            <div class="form-group mt-3">
                <label for="signature">Signature</label>
                <input type="text" name="signature" class="form-control" id="signature" placeholder="Signature" required
                    value="{{ $data->signature }}">
            </div>

            <div class="user_info">
                <h4 class="mt-4">Informasi Pengaju</h4>
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
                            <td>Nama</td>
                            <td>User - Nama</td>
                            <td>
                                <input type="checkbox" value="name" name="type[]">
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>User - Alamat</td>
                            <td>
                                <input type="checkbox" value="alamat" name="type[]">
                            </td>
                        </tr>
                        @if ($tolol->type == 'name')
                            <tr>
                                <td>Prodi</td>
                                <td>name - Prodi</td>
                                <td>
                                    <input type="checkbox" value="prodi" name="type[]">
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>NIM</td>
                            <td>User - NIM</td>
                            <td>
                                <input type="checkbox" value="nim" name="type[]">
                            </td>
                        </tr>
                        <tr>
                            <td>No Telefon</td>
                            <td>User - No Telefon</td>
                            <td>
                                <input type="checkbox" value="no_telfon" name="type[]">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

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
        <input type="submit" value="tolol insert">
    </form>
@endsection
