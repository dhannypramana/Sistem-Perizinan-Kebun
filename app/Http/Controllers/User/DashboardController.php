<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function show()
    {
        return view('user.dashboard', [
            'active' => 'dashboard',
            'researchCount' => Research::where('user_id', auth()->user()->id)->get()->count(),
            'dataRequestCount' => DataRequest::where('user_id', auth()->user()->id)->get()->count(),
            'loanCount' => Loan::where('user_id', auth()->user()->id)->get()->count(),
            'practicumCount' => Practicum::where('user_id', auth()->user()->id)
                ->select('license_number', 'created_at', 'status',)
                ->distinct()
                ->latest()
                ->get()
                ->count()
        ]);
    }
}
