@extends('services.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/license_generator.css') }}">
@endsection

@section('container')
    <h2>Format Surat Balasan Penelitian</h2>

    <div class="head">
        <h5>Kop Surat</h5>
        <img src="{{ asset('/assets/images/kop.png') }}" alt="Kop Surat" class="kop">
    </div>

    <div class="body">
        <div class="form-group mt-3">
            <label for="title">Judul Surat</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Judul Surat" required
                value="Sertifikasi Hasil Perizinan Penelitian">
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
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>User - Alamat</td>
                        <td>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Prodi</td>
                        <td>User - Prodi</td>
                        <td>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>User - NIM</td>
                        <td>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>No Telefon</td>
                        <td>User - No Telefon</td>
                        <td>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="research_info">
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
        </div>
    </div>
@endsection
