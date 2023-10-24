<table class="table table-borderless">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Tanggal Pengajuan</th>
            <th>No. Izin</th>
            <th>Lokasi Praktikum</th>
            <th>Jumlah Mahasiswa</th>
            <th>Dosen Penanggung Jawab Praktikum</th>
            <th>Nama Asisten</th>
            <th>Mata Kuliah</th>
            <th>Penanggung Jawab Kelas</th>
            <th>Fasilitas yang Digunakan</th>
            <th>Waktu praktikum</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($practicum as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->created_at->format('j F Y, H:i a') }}</td>
                <td>{{ $p->license_number }}</td>
                <td>{{ $p->location }}</td>
                <td>{{ $p->personnel }}</td>
                <td>{{ $p->practicum_supervisor }}</td>
                <td>{{ $p->assistant }}</td>
                <td>{{ $p->subject }}</td>
                <td>{{ $p->class_supervisor }}</td>
                <td>{{ $p->facility }}</td>
                <td>
                    @php
                        $day = date('d', strtotime($p->start_time));
                        $month = date('M', strtotime($p->start_time));
                        $year = date('Y', strtotime($p->start_time));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }} -
                    @php
                        $day = date('d', strtotime($p->end_time));
                        $month = date('M', strtotime($p->end_time));
                        $year = date('Y', strtotime($p->end_time));
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
            <td>Jumlah Proposal Mata Kuliah Praktikum</td>
            <td>{{ $practicumCount }}</td>
        </tr>
    </tbody>
</table>
