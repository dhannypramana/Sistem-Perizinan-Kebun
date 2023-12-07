<?php

namespace Database\Seeders;

use App\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loan::create([
            'id' => 1,
            'user_id' => 1,
            'license_number' => 'KFSPS202311291',
            'loan_number' => 1,
            'status' => 0,
            'is_reviewed' => 0,
            'category' => 'Alat',
            'title' => 'Paranet Persemayan',
            'quantity' => 1,
            'activity' => 'Penelitian',
            'purpose' => 'Menguji Sample',
            'start_time' => '2023-11-12',
            'end_time' => '2023-11-29',
            'agency_license' => 'KFSPL202311291.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Loan::create([
            'id' => 2,
            'user_id' => 2,
            'license_number' => 'KFSPS202311292',
            'loan_number' => 2,
            'status' => 0,
            'is_reviewed' => 0,
            'category' => 'Ruangan',
            'title' => 'Ruangan Rumah Kaca',
            'quantity' => 5,
            'activity' => 'Penelitian',
            'purpose' => 'Menanam Kecambah',
            'start_time' => '2023-11-12',
            'end_time' => '2023-11-29',
            'agency_license' => 'KFSPL202311292.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
