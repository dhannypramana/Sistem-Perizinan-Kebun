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
        $service = substr($request->license_number, 3, 2);

        if ($service == "PL") {
            $research = Research::where('license_number', $request->license_number)->first();
            return redirect()->intended('storage/document/research/' . $research->agency_license);
        } else if ($service == "PD") {
            $data_request = DataRequest::where('license_number', $request->license_number)->first();
            return redirect()->intended('storage/document/data_request/' . $data_request->agency_license);
        } else if ($service == "PS") {
            $loan = Loan::where('license_number', $request->license_number)->first();
            return redirect()->intended('storage/document/loan/' . $loan->agency_license);
        } else if ($service == "PK") {
            $practicum = Practicum::where('license_number', $request->license_number)->first();
            return redirect()->intended('storage/document/practicum/' . $practicum->agency_license);
        } else {
            return;
        }
    }
}
