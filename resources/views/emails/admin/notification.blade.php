<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifikasi Pengajuan Baru</title>
</head>

<body>
    <h1>Pengajuan Baru</h1>

    <div>
        <h4>Informasi Pengaju</h4>
        <table>
            <tr>
                <td>Nama</td>
                <td>{{ $mailData->user->name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>{{ $mailData->user->student_number }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>{{ $mailData->user->academic_program }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $mailData->user->email }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $mailData->user->address }}</td>
            </tr>
            <tr>
                <td>No. Telefon</td>
                <td>{{ $mailData->user->phone_number }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h4>Informasi Pengajuan</h4>
        <table>
            <tr>
                <td>Jenis Pengajuan</td>
                <td>{{ $dataService }}</td>
            </tr>
            <tr>
                <td>No. Izin</td>
                <td>{{ $mailData->license_number }}</td>
            </tr>
        </table>
    </div>

    <p>Segera Lakukan Konfirmasi <a href="{{ $link }}">Disini</a></p>
</body>

</html>
