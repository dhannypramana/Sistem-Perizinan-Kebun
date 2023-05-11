<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public static function show()
    {
        return view('user.profile', [
            'active' => 'profile',
            'user' => auth()->user(),
        ]);
    }

    public static function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'academic_program' => ['required'],
            'student_number' => ['required', 'min:9'],
            'phone_number' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $user = User::where('id', auth()->user()->id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'academic_program' => $request->academic_program,
                'student_number' => $request->student_number,
                'phone_number' => $request->phone_number
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

        return response()->json([
            'success' => "Kamu Telah Berhasil Melakukan Update Profile Kamu"
        ]);
    }
}
