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
            'title' => 'Format Surat Balasan Pengajuan Penelitian',
            'footnote' => 'Ini Adalah Footnote',
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Permintaan Data',
            'title' => 'Format Surat Balasan Pengajuan Permintaan Data',
            'footnote' => 'Ini Adalah Footnote',
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Peminjaman Sarana dan Prasarana',
            'title' => 'Format Surat Balasan Pengajuan Peminjaman Sarana dan Prasarana',
            'footnote' => 'Ini Adalah Footnote',
        ]);
        LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => 'Format Surat Balasan Pengajuan Praktikum',
            'title' => 'Format Surat Balasan Pengajuan Praktikum',
            'footnote' => 'Ini Adalah Footnote',
        ]);
    }
}
