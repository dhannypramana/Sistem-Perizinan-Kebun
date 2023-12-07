<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // ResearchSeeder::class,
            // DataRequestSeeder::class,
            // LoanSeeder::class,
            LicenseFormatSeeder::class,
            LicenseFormatServiceSeeder::class,
            LicenseFormatUserSeeder::class,
            LocationSeeder::class,
            FacultySeeder::class
        ]);
    }
}
