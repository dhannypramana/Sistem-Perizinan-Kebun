<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public static function show()
    {
        return view('auth.register');
    }

    public static function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'confirmation_password' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors(),
                'err' => 'Terjadi Kesalahan! Periksa Kembali Form Kamu!',
            ]);
        }

        try {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        } catch (QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            if ($errorCode == 1062) {
                $message = $ex->getMessage();

                preg_match("/Duplicate entry '(.*)' for key '(.*)'/", $message, $matches);
                $uniqueFields = array_unique($matches);

                return response()->json([
                    'errors' => 'Data field sudah ada dalam database.',
                    'unique_field' => $uniqueFields
                ], 422);
            } else {
                return response()->json([
                    'errors' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti.'
                ], 500);
            }
        }

        event(new Registered($user));

        return response()->json([
            'success' => 'Register berhasil, Silahkan Login!',
        ]);
    }
}
