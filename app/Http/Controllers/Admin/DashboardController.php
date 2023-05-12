<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function show()
    {
        return view('admin.dashboard', [
            'active' => 'dashboard'
        ]);
    }
}
