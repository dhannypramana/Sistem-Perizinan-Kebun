<?php

namespace Database\Seeders;

use App\Models\Research;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * User Seeder
         */
        User::create([
            'id' => 1,
            'name' => 'Dhanny Adhi Pramana',
            'email' => 'dhanny.118140182@student.itera.ac.id',
            'password' => Hash::make('dani'),
            'student_number' => '118140182',
            'address' => 'Jalan Nusa Indah No.2, RT.024/RW.000, Sumur Batu, Teluk Betung Utara, Bandar Lampung.',
            'phone_number' => '83191831403',
            'academic_program' => 'Teknik Informatika',
            'major' => 'Fakultas Teknologi Produksi',
            'role' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 2,
            'name' => 'Muhammad Popo',
            'email' => 'popo@if.itera.ac.id',
            'password' => Hash::make('popo'),
            'student_number' => '123123123',
            'address' => 'Bandar Lampung',
            'phone_number' => '087898241376',
            'academic_program' => 'Program Studi Teknik Informatika',
            'major' => 'Fakultas Teknologi Industri',
            'role' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /**
         * Superadmin & Admin Seeder
         */
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin Dev',
            'email' => 'dev.admin@admin.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admindev'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin Super',
            'email' => 'super.admin@admin.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('adminsuper'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'superadmin',
        ]);
    }
}
