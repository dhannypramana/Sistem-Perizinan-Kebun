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
        $user = User::where('email', 'example.popo@.gmail.com')->first();
        $userID = 'f5f21e04-3512-4628-b33c-86b0b9b5ae91';

        DataRequest::create([
            'id' => Str::uuid(),
            'user_id' => $userID,
            'license_number' => 'KFSPD202310252',
            'data_number' => 2,
            'status' => 0,
            'is_reviewed' => 0,
            'admin_message' => '',
            'category' => 'Tanaman',
            'title' => 'Data Persebaran',
            'purpose' => 'Kacang Kacangan',
            'agency' => 'Institut Teknologi Sumatera',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DataRequest::create([
            'id' => Str::uuid(),
            'user_id' => $userID,
            'license_number' => 'KFSPD202310253',
            'data_number' => 3,
            'status' => 0,
            'is_reviewed' => 0,
            'admin_message' => '',
            'category' => 'Tanaman OKE',
            'title' => 'Data Persebaran OKE',
            'purpose' => 'Kacang Kacangan OKE',
            'agency' => 'Institut Teknologi Sumatera OKE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
