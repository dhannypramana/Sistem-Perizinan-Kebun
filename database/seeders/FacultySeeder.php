<?php

namespace Database\Seeders;

use App\Models\AcademicProgram;
use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fs = Faculty::create([
            'id' => Str::uuid(),
            'faculty' => 'Fakultas Sains'
        ]);

        $ftik = Faculty::create([
            'id' => Str::uuid(),
            'faculty' => 'Fakultas Teknologi Infrastruktur dan Kewilayahan'
        ]);

        $fti = Faculty::create([
            'id' => Str::uuid(),
            'faculty' => 'Fakultas Teknologi Industri'
        ]);

        /**
         * Fakultas Sains
         */

        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Fisika',
            'faculty_id' => $fs->id
        ]);

        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Matematika',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Biologi',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Kimia',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Farmasi',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Atmosfer dan Keplanetan',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Sains Aktuaria',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Sains Lingkungan Kelautan',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Sains Data',
            'faculty_id' => $fs->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Magister Fisika',
            'faculty_id' => $fs->id
        ]);

        /**
         * Fakultas Teknologi Infrastruktur dan Kewilayahan
         */

        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Geomatika',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Perencanaan Wilayah dan Kota',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Sipil',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Arsitektur',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Lingkungan',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Kelautan',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Desain Komunikasi Visual',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Arsitektur Lanskap',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Perkeretaapian',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Rekayasa Tata Kelola Air Terpardu',
            'faculty_id' => $ftik->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Pariwisata',
            'faculty_id' => $ftik->id
        ]);

        /**
         * Fakultas Teknologi Industri
         */

        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Elektro',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Geofisika',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Informatika',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Geologi',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Mesin',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Industri',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Kimia',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Fisika',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Biosistem',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknologi Industri Pertanian',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknologi Pangan',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Sistem Energi',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Pertambangan',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Material',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Telekomunikasi',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Rekayasa Kehutanan',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Biomedik',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Teknik Rekayasa Keolahragaan',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Rekayasa Minyak dan Gas',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Rekayasa Instrumentasi dan Automasi',
            'faculty_id' => $fti->id
        ]);
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => 'Program Studi Rekayasa Kosmetik',
            'faculty_id' => $fti->id
        ]);
    }
}
