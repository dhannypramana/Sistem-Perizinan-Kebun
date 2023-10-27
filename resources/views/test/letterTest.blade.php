<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <title>reply_123PD</title>
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
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="letterhead">
        <img src="{{ asset('/storage/image/kop_1698179126251023032526551922487.png') }}" alt="letterhead" class="w-100">
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
                    25 Oktober 2023
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
                        Disetujui
                    </span>
                </td>
            </tr>
        </table>
        <div class="form-group mt-3">
            <div class="font-weight-bold">
                <span>Yth. Ketua JTPI
                </span><br>
                <span>Institut Teknologi Sumatera</span> <br>
                <span>di</span> <br>
                <span>Kampus ITERA</span>
            </div>
        </div>
        <p class="text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur repellendus
            minima esse unde nobis perspiciatis sequi magnam possimus dolor, aliquam, maxime architecto sunt.
            Dolorum, quis. Repellendus necessitatibus dolore quaerat alias laboriosam labore blanditiis nobis
            corporis voluptatum sit sint numquam ipsam, quisquam harum inventore nisi mollitia, quae dolores
            accusantium. Hic quisquam molestias, sequi fugit et aspernatur! A modi amet cumque consequuntur
            impedit
            quis earum adipisci molestiae. </p>

        <table>
            <tr class="tr-si">
                <td class="td-si">Mata Kuliah</td>
                <td class="td-si">ABC</td>
                <td class="td-si">ABC</td>
            </tr>
            <tr class="tr-si">
                <td class="td-si">Waktu Mulai</td>
                <td class="td-si">ABC</td>
            </tr>
            <tr class="tr-si">
                <td class="td-si">Tanggal Mulai</td>
                <td class="td-si">ABC</td>
            </tr>
        </table>

        <p class="text-justify mt-2">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur repellendus
            minima esse unde nobis perspiciatis sequi magnam possimus dolor, aliquam, maxime architecto sunt.
            Dolorum, quis. Repellendus necessitatibus dolore quaerat alias laboriosam labore blanditiis nobis
            corporis voluptatum sit sint numquam ipsam, quisquam harum inventore nisi mollitia, quae dolores
            accusantium. Hic quisquam molestias, sequi fugit et aspernatur! A modi amet cumque consequuntur
            impedit
            quis earum adipisci molestiae.
        </p>

        <div class="license-footer">
            Kepala UPT Konservasi Flora Sumatera
            <div class="signature mt-3">
                <img src="{{ asset('/storage/image/signature_1698179126251023032526841343790.png') }}" alt="letterhead"
                    width="100">
            </div>
            <div class="mt-3">
                <div>Dhanny Adhi Pramana</div>
                <div>NIP. 128SJHDSJHDGSJHDg</div>
            </div>
        </div>
        <div>
            <img src="{{ asset('/storage/image/footer_image_16983001402610231302201913868513.png') }}" alt="letterhead"
                class="footer_image">
        </div>
    </div>
</body>

</html>
