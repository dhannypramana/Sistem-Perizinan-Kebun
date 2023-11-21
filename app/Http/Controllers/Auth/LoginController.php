<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public static function show()
    {
        return view('auth.login');
    }

    public static function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                // 'student_itera_email'
            ],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors(),
                'err' => 'Terjadi Kesalahan! Periksa Kembali Form Kamu!',
            ]);
        }

        $credentials = request([
            'email',
            'password'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 1,
                'err' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'success' => 'Selamat Datang Kembali!',
            'user' => auth()->user()->is_admin,
        ]);
    }
}
