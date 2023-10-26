<table class="table table-borderless">
    <thead>
        <tr>
            <th>Nomor</th>

            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Jurusan</th>
            <th>Prodi</th>

            <th>Tanggal Pengajuan</th>
            <th>No. Izin</th>
            <th>Kategori Peminjaman</th>
            <th>Sarana yang Dipinjam</th>
            <th>Jumlah Peminjaman</th>
            <th>Nama Kegiatan</th>
            <th>Tujuan Peminjaman</th>
            <th>Waktu Peminjaman</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loan as $l)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $l->user->name }}</td>
                <td>{{ $l->user->student_number }}</td>
                <td>{{ $l->user->address }}</td>
                <td>{{ $l->user->phone_number }}</td>
                <td>{{ $l->user->major }}</td>
                <td>{{ $l->user->academic_program }}</td>

                <td>{{ $l->created_at->format('j F Y, H:i a') }}</td>
                <td>{{ $l->license_number }}</td>
                <td>{{ $l->category }}</td>
                <td>{{ $l->title }}</td>
                <td>{{ $l->quantity }}</td>
                <td>{{ $l->activity }}</td>
                <td>{{ $l->purpose }}</td>
                <td>
                    @php
                        $day = date('d', strtotime($l->start_time));
                        $month = date('M', strtotime($l->start_time));
                        $year = date('Y', strtotime($l->start_time));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }} -
                    @php
                        $day = date('d', strtotime($l->end_time));
                        $month = date('M', strtotime($l->end_time));
                        $year = date('Y', strtotime($l->end_time));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }}
                </td>
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
            <td></td>
            <td></td>
            <td>Jumlah Proposal Peminjaman</td>
            <td>{{ $loanCount }}</td>
        </tr>
    </tbody>
</table>
