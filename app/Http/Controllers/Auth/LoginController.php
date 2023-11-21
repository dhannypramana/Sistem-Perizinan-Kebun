<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public static function show()
    {
        return view('auth.login');
    }

    public static function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'student_itera_email'
            ],
            'password' => 'required'
        ]);

        $credentials = request([
            'email',
            'password'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 1,
                'error' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'success' => 'Selamat Datang Kembali!',
            'user' => auth()->user()->is_admin,
        ]);
    }
}
