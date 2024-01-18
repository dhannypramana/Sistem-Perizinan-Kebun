<?php

namespace Database\Seeders;

use App\Models\LicenseFormatUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LicenseFormatUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'name',
            'type_name' => 'Nama'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'address',
            'type_name' => 'Alamat'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'email',
            'type_name' => 'Email'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'academic_program',
            'type_name' => 'Program Studi'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'major',
            'type_name' => 'Fakultas'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'student_number',
            'type_name' => 'NIM/NIP'
        ]);
        LicenseFormatUser::create([
            'id' => Str::uuid(),
            'type' => 'phone_number',
            'type_name' => 'No Telefon'
        ]);
    }
}
