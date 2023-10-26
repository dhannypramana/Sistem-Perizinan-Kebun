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
            <th>Jadwal Praktikum</th>
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
                        $day = date('d', strtotime($p->date));
                        $month = date('M', strtotime($p->date));
                        $year = date('Y', strtotime($p->date));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }}, {{ $p->start_time }} -
                    {{ $p->end_time }}
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
