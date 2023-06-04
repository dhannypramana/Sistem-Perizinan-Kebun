<!DOCTYPE html>
<html>

<head>
    <title>Surat</title>
</head>

<style>
    .kop {
        margin: 0;
        padding: 0;
        width: 100%;
    }
</style>

<body>
    <img class="kop" src="{{ asset('/assets/images/kop.png') }}" alt="" srcset="">
    <h2>Nomor Surat: {{ $nomor_surat }}</h2>
    <p>Tanggal Surat: {{ $tanggal_surat }}</p>
    <p>Kepada:</p>
    <p>{{ $nama_penerima }}</p>
    <hr>
    <p>{{ $isi_surat }}</p>
</body>

</html>
