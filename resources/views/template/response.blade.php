<!DOCTYPE html>
<html lang="en">

<?php
use Carbon\Carbon;
?>

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
            font-family: 'Times New Roman', Times, serif;
            line-height: normal;
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

        .footer_image {
            width: 100%;
            height: 40px;
            object-fit: cover;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .tr-si,
        .th-si,
        .td-si {
            border-top: 1px solid;
            border-bottom: 1px solid;
            border-left: 1px solid;
            border-right: 1px solid;
            padding-left: 8px;
            padding-right: 8px;
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
                    <span>{{ $letterNumber }}</span>
                </td>
                <td class="text-right">
                    {{ $data->updated_at->format('j F Y') }}
                </td>
            </tr>
            <tr>
                <td>
                    <span>Lampiran</span>
                    <span class="ml-2">: </span>
                    <span>{{ $letterAttachment }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Perihal</span>
                    <span class="space-lethead">: </span>
                    <span>
                        @if ($data->title)
                            {{ $data->format_title }}
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

        <table>
            @if ($user_info->isNotEmpty())
                @foreach ($user_info as $ui)
                    <tr>
                        <td>{{ $ui->type_name }}</td>
                        <td>&nbsp;:&nbsp;{{ $user[$ui->type] }}</td>
                    </tr>
                @endforeach
            @endif
            @if ($service_info->isNotEmpty())
                @if ($isPracticum)
                    @foreach ($service_info as $si)
                        <tr class="tr-si">
                            <td class="td-si">{{ $si->type_name }}</td>
                            @for ($i = 0; $i < $practicumCount; $i++)
                                <td class="td-si">
                                    @if ($si->type == 'start_date')
                                        @php
                                            $startDate = Carbon::parse($service_data[$i][$si->type]);
                                            $dayName = $startDate->format('l');
                                        @endphp
                                        {{ $dayName }},
                                    @endif
                                    {{ $service_data[$i][$si->type] }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                @else
                    @foreach ($service_info as $si)
                        <tr>
                            <td>{{ $si->type_name }}</td>
                            <td>&nbsp;:&nbsp;{{ $service_data[$si->type] }}</td>
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
            <img src="https://quickchart.io/qr?text=http://sisperlak.test/perizinan/verif/{{ $license_number }}" alt="qr">
            {{-- Kepala UPT Konservasi Flora Sumatera
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
            </div> --}}
        </div>
        <div>
            @if ($footer_images->isEmpty())
                <div class="py-3 text-center bg-white">
                    Belum ada Footer Image
                </div>
            @else
                <img src="{{ asset('/storage/image/' . $data->footer_image->footer_image) }}" alt="footer-image"
                    class="footer_image">
            @endif
        </div>
    </div>
</body>

</html>
