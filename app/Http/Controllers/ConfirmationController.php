<?php

namespace App\Http\Controllers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public static function getService($license_number)
    {
        $service = substr($license_number, 3, 2);

        if ($service == "PL") {
            $data = Research::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PD") {
            $data = DataRequest::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PS") {
            $data = Loan::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PK") {
            $data = Practicum::where('license_number', $license_number)->get();
            return $data;
        }
    }

    public static function accept(Request $request)
    {
        $service = ConfirmationController::getService($request->license_number);

        if (substr($request->license_number, 3, 2) == 'PK') {
            foreach ($service as $s) {
                $s->update([
                    'is_reviewed' => true,
                    'status' => 'Disetujui',
                ]);
            }
        } else {
            $service->update([
                'is_reviewed' => true,
                'status' => 'Disetujui',
            ]);
        }

        return response()->json([
            'message' => 'Berhasil Setujui Ajuan!',
            'license_number' => $request->license_number,
            // 'license_format' => $request->license_format
        ]);
    }

    public static function reject(Request $request)
    {
        $service = ConfirmationController::getService($request->license_number);

        if (substr($request->license_number, 3, 2) == 'PK') {
            foreach ($service as $s) {
                $s->update([
                    'is_reviewed' => true,
                    'status' => 'Ditolak',
                    'admin_message' => $request->admin_message,
                ]);
            }
        } else {
            $service->update([
                'is_reviewed' => true,
                'status' => 'Ditolak',
                'admin_message' => $request->admin_message,
            ]);
        }

        return response()->json([
            'message' => 'Berhasil Menolak Ajuan!',
        ]);
    }
}
