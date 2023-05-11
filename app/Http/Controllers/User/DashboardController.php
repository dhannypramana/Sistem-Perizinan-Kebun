<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function show()
    {
        return view('user.dashboard', [
            'active' => 'dashboard'
        ]);
    }
}
