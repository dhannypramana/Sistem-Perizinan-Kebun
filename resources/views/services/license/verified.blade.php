<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <title>Pengajuan Perizinan | UPA Kebun Raya ITERA</title>
    <style>
        /* body {
            background-color: aqua;
        } */
    </style>
</head>
<body class="vh-100 px-5 bg-gradient-primary text-white">
    <nav class="nav">
        <div class="w-100 py-4">
            <div class="d-flex align-items-center">
                <img class="nav_img" src="https://kebunraya.itera.ac.id/wp-content/uploads/2022/11/cropped-kebunnn-1.png" alt="logo_kebun">
                <p class="m-0 font-weight-bold ml-2">UPA Kebun Raya ITERA</p>
            </div>
        </div>
    </nav>
    <div class="row p-3">
        <div class="col d-flex align-items-center justify-content-center">
            <div>
                <h1>Data Pengajuan Perizinan Terferivikasi</h1>
                <hr class="border">
                <p>Adalah benar dan tercatat di dalam sistem perizinan kebun raya dengan data sebagai berikut:</p>

                <table class="table table-bordered">
                    <tr>
                        <td class="text-white">No. Izin</td>
                        <td class="text-white">{{ $data->license_number }}</td>
                    </tr>
                    <tr>
                        <td class="text-white">Nama Pengaju</td>
                        <td class="text-white">{{ $data->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-white">Layanan Pengajuan</td>
                        <td class="text-white">
                            {{ $layananPengajuan }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-white">Fakultas</td>
                        <td class="text-white">{{ $data->user->major }}</td>
                    </tr>
                    <tr>
                        <td class="text-white">Program Studi</td>
                        <td class="text-white">{{ $data->user->academic_program }}</td>
                    </tr>
                    <tr>
                        <td class="text-white">Status Pengajuan</td>
                        <td class="text-white">{{ $data->status ? 'Disetujui' : 'Ditolak' }}</td>
                    </tr>
                </table>

                <small class="text-sm-left">Copyright © Kebun Raya ITERA | Sistem Perizinan Layanan 2023</small>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <img src="https://silabor.itera.ac.id/assets/fitrah/img/verif3.svg?>" alt="verif">
        </div>
    </div>
</body>
</html>
