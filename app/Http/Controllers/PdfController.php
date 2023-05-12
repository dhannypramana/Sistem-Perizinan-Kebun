<?php

namespace App\Http\Controllers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $service_type = substr($request->license_number, 3, 2);

        $service = null;
        $path = null;

        if ($service_type == "PL") {
            $service = Research::where('license_number', $request->license_number)->first();
            $path = 'storage/document/research/' . $service->agency_license;
        } else if ($service_type == "PD") {
            $service = DataRequest::where('license_number', $request->license_number)->first();
            $path = 'storage/document/data_request/' . $service->agency_license;
        } else if ($service_type == "PS") {
            $service = Loan::where('license_number', $request->license_number)->first();
            $path = 'storage/document/loan/' . $service->agency_license;
        } else if ($service_type == "PK") {
            $service = Practicum::where('license_number', $request->license_number)->first();
            $path = 'storage/document/practicum/' . $service->agency_license;
        } else {
            return;
        }

        return view('pdf', [
            'path' => $path,
            'service' => $service,
        ]);
    }
}
