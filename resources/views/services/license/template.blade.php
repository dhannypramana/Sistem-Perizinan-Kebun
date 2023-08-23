<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="{{ asset('assets/css/template.css') }}">
    <link href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <title>{{ $data->format_title }}</title>
</head>

<body>
    <div class="container mb-5 border">
        {{-- Letterhead --}}
        <div class="letterhead">
            <img src="{{ asset('/storage/image/' . $letterheads[0]->letterhead) }}" alt="letterhead" width="500">
        </div>

        <div class="license-wrapper">
            <div class="license-head d-flex justify-content-between ml-auto mr-auto">
                <div class="meta">
                    <table>
                        <tr>
                            <td>Nomor</td>
                            <td>
                                <span>: </span>
                                <span class="ml-2">006/IT9.4.5/LL/2023</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>
                                <span>: </span>
                                <span class="ml-2">-</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>
                                <span>: </span>
                                <span class="ml-2">{{ $data->title }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="date">
                    <p>{{ $data->updated_at->format('j F Y') }}</p>
                </div>
            </div>

            <div class="license-receiver mt-4">
                <p>
                    <span>Yth. Ketua Jurusan Teknologi Produksi dan Industri</span>
                    <span>Institut Teknologi Sumatera</span>
                    <span>di</span>
                    <span>Kampus ITERA</span>
                </p>
            </div>

            <div class="license-body">
                <p>Sehubungan dengan Surat Jurusan Teknologi Produksi dan Industri Nomor 1277/IT9.3.3/TA.00.00/2023 pada
                    13 Februari 2023 tentang Permohonan Izin Lokasi Praktikum Prodi Rekayasa Kehutanan bagi mahasiswa
                    semester 4 dan 6 Semester Genap Tahun Akademik 2022/2023, maka dengan ini Unit Pelaksana Teknis
                    Konservasi Flora Sumatera (UPT KFS) memberikan izin kegiatan tersebut dengan rincian sebagai
                    berikut:</p>
                @if ($service_info->isNotEmpty())
                    <table class="table table-bordered">
                        <tr>
                            <th>No.</th>
                            @foreach ($service_info as $si)
                                <th>{{ $si->type_name }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($service_info as $si)
                                @if ($loop->index == 0)
                                    <td>{{ $loop->index + 1 }}</td>
                                @endif
                                <td class="text-capitalize">{{ $service_data[$si->type] }}</td>
                            @endforeach
                        </tr>
                    </table>
                @endif
                <p>Adapun dosen pengampu mata kuliah dapat melakukan koordinasi lebih lanjut dengan UPT KFS berkaitan
                    dengan lokasi kegiatan yang ada di Kebun Raya ITERA. Narahubung UPT KFS a.n. Eryka Merdiana, S.P.
                    (082181021850).</p>
                <p>Selama pelaksanaan praktikum, mohon tetap melaksanakan protokol kesehatan sebagaimana yang telah
                    ditetapkan di lingkungan kampus ITERA dan menjaga kebersihan serta keamanan. Demikian surat ini kami
                    sampaikan. Atas kerjasamanya kami ucapkan terima kasih.</p>
            </div>
            {{-- @dd($data) --}}
            <div class="license-footer d-flex flex-column align-items-end">
                <div>{{ $data->signed }}</div>
                <div class="signature mt-3">
                    <img src="{{ asset('/storage/image/' . $signatures[0]->signature) }}" alt="letterhead"
                        width="100">
                </div>
                <div class="mt-3">
                    <div>Alawiyah, S.P., M.Hut.</div>
                    <div>NIP 199112162021212001</div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="signature">
            <img src="{{ asset('/storage/image/' . $signatures[0]->signature) }}" alt="letterhead" width="500">
        </div>
        <p>Judul Format : {{ $data->format_title }}</p>
        <p>Judul Surat : {{ $data->title }}</p>
        <p>Footnote Surat : {{ $data->footnote }}</p>

        @if ($user_info->isNotEmpty())
            <h5>User Info</h5>
            @foreach ($user_info as $ui)
                <p>{{ $ui->info_type }} - {{ $ui->type_name }} - {{ $user[$ui->type] }}</p>
            @endforeach
        @endif

        @if ($service_info->isNotEmpty())
            <h5>Service Info</h5>
            @foreach ($service_info as $si)
                <p>{{ $si->info_type }} - {{ $si->type_name }} -
                    @if ($si->info_type == 'practicum')
                        @foreach ($service_data as $sd)
                            <p>
                                {{ $loop->index + 1 }}. {{ $sd[$si->type] }}
                            </p>
                            <p>Status Pengajuan : {{ $sd->status }}</p>
                        @endforeach
                    @else
                        {{ $service_data[$si->type] }}
                    @endif
                </p>
            @endforeach
        @endif --}}

    {{-- <pre>{{ $service_data }}</pre> --}}
</body>

</html>
