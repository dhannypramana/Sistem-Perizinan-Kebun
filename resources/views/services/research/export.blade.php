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
            <th>Lokasi Penelitian</th>
            <th>Jumlah Personil</th>
            <th>Judul Penelitian</th>
            <th>Waktu Penelitian</th>
            <th>Fasilitas yang digunakan</th>
            <th>Dosen Pembimbing Penelitian</th>
            <th>Dosen Pembimbing Akademik</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($research as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $r->user->name }}</td>
                <td>{{ $r->user->student_number }}</td>
                <td>{{ $r->user->address }}</td>
                <td>{{ $r->user->phone_number }}</td>
                <td>{{ $r->user->major }}</td>
                <td>{{ $r->user->academic_program }}</td>

                <td>{{ $r->created_at->format('j F Y, H:i a') }}</td>
                <td>{{ $r->license_number }}</td>
                <td>{{ $r->location }}</td>
                <td>{{ $r->personnel }}</td>
                <td>{{ $r->title }}</td>
                <td>
                    @php
                        $day = date('d', strtotime($r->start_time));
                        $month = date('M', strtotime($r->start_time));
                        $year = date('Y', strtotime($r->start_time));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }} -
                    @php
                        $day = date('d', strtotime($r->end_time));
                        $month = date('M', strtotime($r->end_time));
                        $year = date('Y', strtotime($r->end_time));
                    @endphp
                    {{ $day }} {{ $month }} {{ $year }}
                </td>
                <td>{{ $r->facility }}</td>
                <td>{{ $r->research_supervisor }}</td>
                <td>{{ $r->academic_supervisor }}</td>
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
            <td></td>
            <td>Jumlah Proposal Penelitian</td>
            <td>{{ $researchCount }}</td>
        </tr>
    </tbody>
</table>
