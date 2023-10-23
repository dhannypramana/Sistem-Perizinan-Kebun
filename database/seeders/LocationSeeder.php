<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'id' => Str::uuid(),
            'name' => 'Kebun Raya',
        ]);
        Location::create([
            'id' => Str::uuid(),
            'name' => 'Arboretrum',
        ]);
        Location::create([
            'id' => Str::uuid(),
            'name' => 'Hutan Serba Guna',
        ]);
    }
}
