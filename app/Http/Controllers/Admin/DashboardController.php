<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function show()
    {
        return view('admin.dashboard', [
            'active' => 'dashboard',
            // 'reviewedResearchCount' => Research::where('is_reviewed', true)->count(),
            // 'unreviewedResearchCount' => Research::where('is_reviewed', false)->count(),
        ]);
    }
}
