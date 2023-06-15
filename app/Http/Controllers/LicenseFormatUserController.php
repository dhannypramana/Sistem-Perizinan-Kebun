<?php

namespace App\Http\Controllers;

use App\Models\LicenseFormatDetail;
use App\Models\LicenseFormatUser;
use Illuminate\Http\Request;

class LicenseFormatUserController extends Controller
{
    public function getLicenseUser()
    {
        $license_format_user = LicenseFormatUser::get();

        return response()->json([
            'status' => 'Sukses get Data',
            'data' => $license_format_user,
        ]);
    }

    public function postLicenseUser(Request $request)
    {
        LicenseFormatDetail::create([
            'license_format_id' => $request->license_format_id,
            'info_type' => $request->info_type,
            'type' => $request->type,
            'type_name' => $request->type_name
        ]);

        return response()->json([
            'status' => 'Sukses post Data',
        ]);
    }

    public function deleteLicenseUser(Request $request)
    {
        $lfd = LicenseFormatDetail::find($request->license_format_details_id);

        try {
            if ($lfd != null) {
                $lfd->delete();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 1,
                'err' => $th->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Sukses Menghapus Informasi'
        ]);
    }
}
