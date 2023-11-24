<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public static function showEdit()
    {
        return view('user.edit_profile', [
            'active' => 'profile',
            'user' => auth()->user(),
        ]);
    }

    public static function changePhoto(Request $request)
    {
        if ($request->hasFile('file')) {
            $user = User::find(auth()->user()->id);

            $extension      = $request->file('file')->extension();
            $fileName       = 'photo' . '_' . auth()->user()->id . '.'  . $extension;

            try {
                Storage::disk('public')->delete('image/' . $user->photo);
                Storage::putFileAs('public/image', $request->file('file'), $fileName);

                $user->update([
                    'photo' => $fileName,
                ]);

                return response()->json([
                    'success' => 'Berhasil mengubah foto profil',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 1,
                    'err' => $th,
                ]);
            }
        }
    }

    public static function deleteUserPhoto(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user->photo == null) {
            return response()->json([
                'status' => 1,
                'err' => 'Belum ada foto profil!',
            ]);
        }

        try {
            Storage::disk('public')->delete('image/' . $user->photo);

            $user->update([
                'photo' => null,
            ]);

            return response()->json([
                'status' => 0,
                'success' => 'Berhasil menghapus foto profil',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 1,
                'err' => $th,
            ]);
        }
    }

    public static function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'academic_program' => ['required'],
            'student_number' => ['required', 'min:9'],
            'phone_number' => ['required'],
            'major' => ['required'],
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
                'major' => $request->major,
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
