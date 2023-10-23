<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public static function show()
    {
        $researchCount = Research::get()->count();
        $dataRequestCount = DataRequest::get()->count();
        $loanCount = Loan::get()->count();
        $practicumCount = Practicum::select('license_number', 'created_at', 'status',)
            ->distinct()
            ->latest()
            ->get()
            ->count();
        $reviewedResearchCount = Research::where('is_reviewed', true)->get()->count();
        $reviewedDataRequestCount = DataRequest::where('is_reviewed', true)->get()->count();
        $reviewedLoanCount = Loan::where('is_reviewed', true)->get()->count();
        $reviewedPracticumCount = Practicum::where('is_reviewed', true)
            ->select('license_number', 'created_at', 'status',)
            ->distinct()
            ->get()
            ->count();

        $reviewedResearchPercentage = 0;
        if ($researchCount == 0) {
            $reviewedResearchPercentage = 0;
        } else {
            $reviewedResearchPercentage = round(($reviewedResearchCount / $researchCount) * 100, 1);
        }

        $reviewedDataRequestPercentage = 0;
        if ($dataRequestCount == 0) {
            $reviewedDataRequestPercentage = 0;
        } else {
            $reviewedDataRequestPercentage = round(($reviewedDataRequestCount / $dataRequestCount) * 100, 1);
        }

        $reviewedLoanPercentage = 0;
        if ($loanCount == 0) {
            $reviewedLoanPercentage = 0;
        } else {
            $reviewedLoanPercentage = round(($reviewedLoanCount / $loanCount) * 100, 1);
        }

        $reviewedPracticumPercentage = 0;
        if ($practicumCount == 0) {
            $reviewedPracticumPercentage = 0;
        } else {
            $reviewedPracticumPercentage = round(($reviewedPracticumCount / $practicumCount) * 100, 1);
        }

        return view('admin.dashboard', [
            'active' => 'dashboard',
            'researchCount' => $researchCount,
            'dataRequestCount' => $dataRequestCount,
            'loanCount' => $loanCount,
            'practicumCount' => $practicumCount,

            'reviewedResearchPercentage' => $reviewedResearchPercentage,
            'reviewedDataRequestPercentage' => $reviewedDataRequestPercentage,
            'reviewedLoanPercentage' => $reviewedLoanPercentage,
            'reviewedPracticumPercentage' => $reviewedPracticumPercentage,
        ]);
    }

    public function showManageAdmins()
    {
        $admins = User::where('role', 'admin')->orWhere('role', 'superadmin')->get();

        return view('admin.manage-admins', [
            'active' => 'manage_admins',
            'admins' => $admins
        ]);
    }

    public function createAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required'],
            // 'confirmation_password' => ['required', 'same:password'],
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
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
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
            'message' => 'Berhasil menambahkan Admin Baru!',
        ]);
    }

    public function editAdmin(Request $request)
    {
        $admin = User::find($request->id);

        $admin->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'Sukses mengupdate Admin!'
        ]);
    }

    public function deleteAdmin(Request $request)
    {
        $checkSuperAdmin = User::where('role', 'superadmin')->count();
        $admin = User::find($request->id);

        if ($admin->role == 'superadmin' && $checkSuperAdmin == 1) {
            return response()->json([
                'status' => 1,
                'message' => 'Minimal terdapat satu super admin'
            ]);
        }

        $admin->delete();

        return response()->json([
            'status' => 0,
            'message' => 'Berhasil Menghapus Admin'
        ]);
    }
}
