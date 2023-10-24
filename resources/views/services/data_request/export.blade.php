<table class="table table-borderless">
    <thead>
        <tr>
            <th>Nomor</th>
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
            <td>Jumlah Proposal Permintaan Data</td>
            <td>{{ $dataRequestCount }}</td>
        </tr>
    </tbody>
</table>
