<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if (!Auth::logout()) {
            return response()->json([
                'error' => 'Ada kesalahan'
            ]);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
