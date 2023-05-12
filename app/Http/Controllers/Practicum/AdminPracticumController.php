<?php

namespace App\Http\Controllers\Practicum;

use App\Http\Controllers\Controller;
use App\Models\Practicum;
use Illuminate\Http\Request;

class AdminPracticumController extends Controller
{
    public function check()
    {
        return view('services.practicum.check', [
            'active' => 'practicum_check',
            'practicum' => Practicum::select('license_number',)
                ->distinct()
                ->paginate(4)
        ]);
    }

    public function details(Request $request)
    {
        $practicum = Practicum::where('license_number', $request->license_number)->get();

        return view('services.practicum.details', [
            'active' => 'practicum_details',
            'practicum' => $practicum,
        ]);
    }
}
