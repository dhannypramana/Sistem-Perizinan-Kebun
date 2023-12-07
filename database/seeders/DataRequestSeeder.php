<?php

namespace Database\Seeders;

use App\Models\DataRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataRequest::create([
            'id' => 1,
            'user_id' => 1,
            'license_number' => 'KFSPD202311291',
            'data_number' => 1,
            'status' => 0,
            'is_reviewed' => 0,
            'category' => 'Tanaman',
            'title' => 'Data Persebaran Kacang Kacangan',
            'purpose' => 'Penelitian',
            'agency' => 'Institut Teknologi Sumatera',
            'category' => 'Tanaman',
            'title' => 'Data Persebaran',
            'purpose' => 'Kacang Kacangan',
            'agency' => 'Institut Teknologi Sumatera',
            'agency_license' => 'KFSPD202311291.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DataRequest::create([
            'id' => 2,
            'user_id' => 2,
            'license_number' => 'KFSPD202311292',
            'data_number' => 2,
            'status' => 0,
            'is_reviewed' => 0,
            'category' => 'Tanaman',
            'title' => 'Data Persebaran Kacang Kacangan',
            'purpose' => 'Penelitian',
            'agency' => 'Institut Teknologi Sumatera',
            'category' => 'Tanaman',
            'title' => 'Data Persebaran',
            'purpose' => 'Kacang Kacangan',
            'agency' => 'Institut Teknologi Sumatera',
            'agency_license' => 'KFSPD202311292.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
