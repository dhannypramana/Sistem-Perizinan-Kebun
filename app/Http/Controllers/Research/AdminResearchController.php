<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminResearchController extends Controller
{
    public static function check()
    {
        return view('services.research.check', [
            'active' => 'research_check',
            'research' => Research::latest()->paginate(4)
        ]);
    }

    public static function details(Request $request)
    {
        $research = Research::where('license_number', $request->license_number)->first();

        $toDate = Carbon::parse($research->start_time);
        $fromDate = Carbon::parse($research->end_time);

        return view('services.research.details', [
            'active' => 'research_check',
            'research' => $research,
            'research_time' => $toDate->diffInDays($fromDate),
        ]);
    }
}
