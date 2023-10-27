<?php

namespace Database\Seeders;

use App\Models\LicenseFormat;
use App\Models\LicenseFormatService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LicenseFormatServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Research
         */

        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'location',
            'type_name' => 'Lokasi Penelitian',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'personnel',
            'type_name' => 'Jumlah Personil',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'title',
            'type_name' => 'Judul Penelitian',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'start_time',
            'type_name' => 'Waktu Mulai',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'end_time',
            'type_name' => 'Waktu Berakhir',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'facility',
            'type_name' => 'Fasilitas',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'research_supervisor',
            'type_name' => 'Dosen Penelitian',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'research',

            'type' => 'academic_supervisor',
            'type_name' => 'Dosen Akademik',
        ]);

        /**
         * Data Request
         */

        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'data_request',

            'type' => 'category',
            'type_name' => 'Kategori Data',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'data_request',

            'type' => 'title',
            'type_name' => 'Judul Data Yang Diajukan',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'data_request',

            'type' => 'purpose',
            'type_name' => 'Keperluan Data',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'data_request',

            'type' => 'agency',
            'type_name' => 'Instansi',
        ]);

        /**
         * Loan
         */

        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'category',
            'type_name' => 'Kategori Peminjaman',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'title',
            'type_name' => 'Sarana yang Dipinjam',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'quantity',
            'type_name' => 'Jumlah',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'activity',
            'type_name' => 'Nama Kegiatan',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'purpose',
            'type_name' => 'Tujuan Pemakaian',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'start_time',
            'type_name' => 'Waktu Mulai',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'loan',

            'type' => 'end_time',
            'type_name' => 'Waktu Berakhir',
        ]);

        /**
         * Praktikum
         */

        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'location',
            'type_name' => 'Lokasi Praktikum',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'personnel',
            'type_name' => 'Jumlah Mahasiswa',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'practicum_supervisor',
            'type_name' => 'Penanggung Jawab Praktikum',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'assistant',
            'type_name' => 'Asisten',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'subject',
            'type_name' => 'Mata Kuliah',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'class_supervisor',
            'type_name' => 'Penanggung Jawab Kelas',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'facility',
            'type_name' => 'Fasilitas',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'start_time',
            'type_name' => 'Waktu Mulai',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'end_time',
            'type_name' => 'Waktu Berakhir',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'start_date',
            'type_name' => 'Tanggal Mulai',
        ]);
        LicenseFormatService::create([
            'id' => Str::uuid(),
            'service' => 'practicum',

            'type' => 'end_date',
            'type_name' => 'Tanggal Berakhir',
        ]);
    }
}
