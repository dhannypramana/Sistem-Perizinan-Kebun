<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Dhanny Adhi Pramana',
            'email' => 'example.dani@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('dani'),
            'remember_token' => 'asdtyuqwe',
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => 0,

            'student_number' => '118140182',
            'address' => 'Jalan Nusa Indah No.2, RT.024/RW.000, Sumur Batu, Teluk Betung Utara, Bandar Lampung.',
            'phone_number' => '83191831403',
            'academic_program' => 'Teknik Informatika',
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Muhammad Popo',
            'email' => 'example.popo@gmail.com',
            'password' => Hash::make('popo'),
            'remember_token' => 'asdtyuqwe',
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => 0,

            'address' => 'Jalan Nusa Indah No.2, RT.024/RW.000, Sumur Batu, Teluk Betung Utara, Bandar Lampung.',
            'phone_number' => '083191831403',
            'academic_program' => 'Teknik Informatika',
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin Dev',
            'email' => 'dev.admin@admin.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admindev'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => 1,
        ]);
    }
}
