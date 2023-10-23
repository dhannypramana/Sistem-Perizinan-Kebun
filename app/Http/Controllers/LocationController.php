<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function show()
    {
        $locations = Location::get();

        return view('locations.location', [
            'active' => 'location',
            'locations' => $locations,
        ]);
    }

    public function getLocation()
    {
        $locations = Location::get();
        return response()->json([
            'locations' => $locations
        ]);
    }

    public function addLocation(Request $request)
    {
        Location::create([
            'id' => Str::uuid(),
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Sukses Menambah Lokasi Baru!'
        ]);
    }

    public function deleteLocation(Request $request)
    {
        $location = Location::find($request->id);

        $location->delete();

        return response()->json([
            'message' => 'Sukses Menghapus Lokasi!',
        ]);
    }

    public function updateLocation(Request $request)
    {
        $location = Location::find($request->id);

        $location->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Sukses Mengupdate Lokasi!',
        ]);
    }
}
