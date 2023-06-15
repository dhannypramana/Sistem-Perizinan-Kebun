<?php

namespace App\Http\Controllers;

use App\Models\LicenseFormatDetail;
use App\Models\LicenseFormatService;
use Illuminate\Http\Request;

class LicenseFormatServiceController extends Controller
{
    public function getLicenseService($service)
    {
        $license_service = LicenseFormatService::where('service', $service)->get();

        return response()->json([
            'status' => 'Sukses get Data',
            'data' => $license_service,
        ]);
    }

    public function postLicenseService(Request $request)
    {
        LicenseFormatDetail::create([
            'license_format_id' => $request->license_format_id,
            'type' => $request->type,
            'type_name' => $request->type_name,
            'info_type' => $request->service,
        ]);

        return response()->json([
            'status' => 'Sukses post Data',
        ]);
    }

    public function deleteLicenseService(Request $request)
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
