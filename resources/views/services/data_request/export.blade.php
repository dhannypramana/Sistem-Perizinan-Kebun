<table class="table table-borderless">
    <thead>
        <tr>
            <th>Nomor</th>

            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Jurusan / Fakultas</th>
            <th>Prodi</th>

            <th>Tanggal Pengajuan</th>
            <th>No. Izin</th>
            <th>Kategori Data</th>
            <th>Data yang Diajukan</th>
            <th>Keperluan Data</th>
            <th>Asal Instansi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataRequest as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $d->user->name }}</td>
                <td>{{ $d->user->student_number }}</td>
                <td>{{ $d->user->address }}</td>
                <td>{{ $d->user->phone_number }}</td>
                <td>{{ $d->user->major }}</td>
                <td>{{ $d->user->academic_program }}</td>

                <td>{{ $d->created_at->format('j F Y, H:i a') }}</td>
                <td>{{ $d->license_number }}</td>
                <td>{{ $d->category }}</td>
                <td>{{ $d->title }}</td>
                <td>{{ $d->purpose }}</td>
                <td>{{ $d->agency }}</td>
            </tr>
        @endforeach
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Jumlah Proposal Permintaan Data</td>
            <td>{{ $dataRequestCount }}</td>
        </tr>
    </tbody>
</table>
