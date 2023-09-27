<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifikasi Pengajuan Baru</title>
</head>

<body>
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
            <tr>
                <td>Status Pengajuan</td>
                <td>
                    @if ($mailData->status == 0)
                        Menunggu Konfirmasi
                    @elseif ($mailData->status == 1)
                        Disetujui
                    @elseif ($mailData->status == 2)
                        Ditolak
                    @endif
                </td>
            </tr>
            @if ($mailData->status == 2)
                <tr>
                    <td>Pesan Admin</td>
                    <td>{{ $mailData->admin_message }}</td>
                </tr>
            @endif
        </table>
    </div>
</body>

</html>
