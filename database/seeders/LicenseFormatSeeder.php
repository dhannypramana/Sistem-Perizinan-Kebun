<?php

namespace Database\Seeders;

use App\Models\LicenseFormat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LicenseFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Penelitian',
            'letterhead' => asset('/storage/image/kop.png'),
            'title' => 'Format Surat Balasan Pengajuan Penelitian',
            'footnote' => 'Ini Adalah Footnote',
            'signature' => 'Ini Adalah Signature'
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Permintaan Data',
            'letterhead' => asset('/storage/image/kop.png'),
            'title' => 'Format Surat Balasan Pengajuan Permintaan Data',
            'footnote' => 'Ini Adalah Footnote',
            'signature' => 'Ini Adalah Signature'
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Peminjaman Sarana dan Prasarana',
            'letterhead' => asset('/storage/image/kop.png'),
            'title' => 'Format Surat Balasan Pengajuan Peminjaman Sarana dan Prasarana',
            'footnote' => 'Ini Adalah Footnote',
            'signature' => 'Ini Adalah Signature'
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Praktikum',
            'letterhead' => asset('/storage/image/kop.png'),
            'title' => 'Format Surat Balasan Pengajuan Praktikum',
            'footnote' => 'Ini Adalah Footnote',
            'signature' => 'Ini Adalah Signature'
        ]);
    }
}
