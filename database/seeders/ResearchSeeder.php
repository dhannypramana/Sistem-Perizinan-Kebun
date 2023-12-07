<?php

namespace Database\Seeders;

use App\Models\Research;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Research::create([
            'id' => 1,
            'user_id' => 1,
            'license_number' => 'KFSPL202311291',
            'research_number' => 1,
            'status' => 0,
            'is_reviewed' => 0,
            'location' => 'Kebun Raya',
            'personnel' => 2,
            'title' => 'Sistem Kajian arstitektur pohon dalam upaya konservasi air dan tanah: studi kasus Kebun Raya ITERA',
            'start_time' => '2023-11-12',
            'end_time' => '2023-11-29',
            'facility' => 'Paranet Persemayan',
            'research_supervisor' => 'Andre Febrianto, S.Kom., M.Eng.',
            'academic_supervisor' => 'Andre Febrianto, S.Kom., M.Eng.',
            'agency_license' => 'KFSPL202311291.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Research::create([
            'id' => 2,
            'user_id' => 2,
            'license_number' => 'KFSPL202311292',
            'research_number' => 2,
            'status' => 0,
            'is_reviewed' => 0,
            'location' => 'Arboretrum',
            'personnel' => 5,
            'title' => 'Sistem pendeteksi persebaran kacang polong di Kebun Raya ITERA',
            'start_time' => '2023-11-12',
            'end_time' => '2023-11-29',
            'facility' => 'Paranet Persemayan',
            'research_supervisor' => 'Andre Febrianto, S.Kom., M.Eng.',
            'academic_supervisor' => 'Andre Febrianto, S.Kom., M.Eng.',
            'agency_license' => 'KFSPL202311291.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
