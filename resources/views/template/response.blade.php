<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <title>reply_{{ $license_number }}</title>
    <style>
        html {
            margin: 0px;
            padding: 0px;
            font-size: 16px;
            font-family: 'Times New Roman', Times, serif
        }

        .head-stock {
            border: 1px solid red;
            display: flex;
            flex-direction: row;
        }

        .space-lethead {
            margin-left: 1.68rem;
        }

        .table {
            table-layout: fixed;
        }

        .license-footer {
            float: right;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="letterhead">
        @if ($letterheads->isEmpty())
            <div class="py-3 text-center bg-white">
                Belum ada Kop Surat
            </div>
        @else
            <img src="{{ asset('/storage/image/' . $letterheads[0]->letterhead) }}" alt="letterhead" class="w-100">
        @endif
    </div>
    <div class="py-4 px-5">
        <table class="w-100">
            <tr>
                <td>
                    <span>Nomor</span>
                    <span class="space-lethead">: </span>
                    <span>006/IT9.4.5/LL/2023</span>
                </td>
                <td class="text-right">
                    {{ $data->updated_at->format('j F Y') }}
                </td>
            </tr>
            <tr>
                <td>
                    <span>Lampiran</span>
                    <span class="ml-2">: </span>
                    <span>-</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Perihal</span>
                    <span class="space-lethead">: </span>
                    <span>
                        @if ($data->title)
                            {{ $data->format_title }} - @if ($status == 0)
                                Menunggu Konfirmasi
                            @elseif ($status == 1)
                                Disetujui
                            @elseif ($status == 2)
                                Ditolak
                            @endif
                        @else
                            <span class="text-danger">Belum Ada Perihal</span>
                        @endif
                    </span>
                </td>
            </tr>
        </table>
        <div class="form-group mt-3">
            <div class="font-weight-bold">
                <span>Yth. Ketua
                    @if ($isPracticum)
                        <span class="text-capitalize">{{ $service_data[0]->user->major }}</span>
                    @else
                        <span class="text-capitalize">{{ $service_data->user->major }}</span>
                    @endif
                </span><br>
                <span>Institut Teknologi Sumatera</span> <br>
                <span>di</span> <br>
                <span>Kampus ITERA</span>
            </div>
        </div>
        @if ($body !== null)
            <p class="text-justify">{{ $body->body }}</p>
        @else
            <p class="text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur repellendus
                minima esse unde nobis perspiciatis sequi magnam possimus dolor, aliquam, maxime architecto sunt.
                Dolorum, quis. Repellendus necessitatibus dolore quaerat alias laboriosam labore blanditiis nobis
                corporis voluptatum sit sint numquam ipsam, quisquam harum inventore nisi mollitia, quae dolores
                accusantium. Hic quisquam molestias, sequi fugit et aspernatur! A modi amet cumque consequuntur
                impedit
                quis earum adipisci molestiae.</p>
        @endif
        <table class="table table-borderless mt-2">
            @if ($user_info->isNotEmpty())
                {{-- <h5 class="font-weight-bold m-0 mr-3">Informasi Pengaju</h5> --}}
                @foreach ($user_info as $ui)
                    <tr>
                        <td>
                            {{ $ui->type_name }}
                        </td>
                        <td>
                            {{ $user[$ui->type] }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>

        <table class="table table-borderless mt-2">
            @if ($service_info->isNotEmpty())
                {{-- <h5 class="font-weight-bold m-0 mr-3">Informasi Pengajuan</h5> --}}
                @if ($isPracticum)
                    @foreach ($service_info as $si)
                        <div class="col">
                            <div class="row">
                                <h5>{{ $si->type_name }}</h5>
                            </div>
                            <div class="row">
                                <ul>
                                    @for ($i = 0; $i < $practicumCount; $i++)
                                        <li>{{ $service_data[$i][$si->type] }}</li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($service_info as $si)
                        <tr>
                            <td>
                                {{ $si->type_name }}
                            </td>
                            <td>
                                {{ $service_data[$si->type] }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endif
        </table>
        {{-- <div class="page-break"></div> --}}
        <p class="text-justify mt-2">
            {{ $data->footer }}
        </p>
        <div class="license-footer">
            Kepala UPT Konservasi Flora Sumatera
            <div class="signature mt-3">
                @if ($signatures->isEmpty())
                    <div class="border rounded bg-white p-3">
                        Belum ada TTD
                    </div>
                @else
                    <img src="{{ asset('/storage/image/' . $signatures[0]->signature) }}" alt="letterhead"
                        width="100">
                @endif
            </div>
            <div class="mt-3">
                @if (!$data->signed)
                    Belum Ada Tertanda
                @else
                    <div>{{ $data->signed }}</div>
                @endif
                @if (!$data->nip)
                    <div>
                        Belum Ada NIP Tertanda
                    </div>
                @else
                    <div>NIP. {{ $data->nip }}</div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
