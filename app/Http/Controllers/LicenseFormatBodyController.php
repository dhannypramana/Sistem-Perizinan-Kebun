<?php

namespace App\Http\Controllers;

use App\Models\LicenseFormatBody;
use Illuminate\Http\Request;

class LicenseFormatBodyController extends Controller
{
    public function createLicenseBody(Request $request)
    {
        LicenseFormatBody::create([
            'body' => $request->body,
            'license_number' => $request->license_number,
            'license_format_id' => $request->license_format_id,
        ]);

        return response()->json([
            'message' => 'Sukses Menambah Data'
        ]);
    }

    public function updateLicenseBody(Request $request)
    {
        $lfb = LicenseFormatBody::where('id', $request->id)->first();

        $lfb->update([
            'id' => $request->id,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Sukses Update Data',
        ]);
    }
}
