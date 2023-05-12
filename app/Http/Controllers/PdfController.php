<?php

namespace App\Http\Controllers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $service_type = substr($request->license_number, 3, 2);

        $data = null;
        $path = null;

        if ($service_type == "PL") {
            $data = Research::where('license_number', $request->license_number)->first();
            $path = 'storage/document/research/' . $data->agency_license;
        } else if ($service_type == "PD") {
            $data = DataRequest::where('license_number', $request->license_number)->first();
            $path = 'storage/document/data_request/' . $data->agency_license;
        } else if ($service_type == "PS") {
            $data = Loan::where('license_number', $request->license_number)->first();
            $path = 'storage/document/loan/' . $data->agency_license;
        } else if ($service_type == "PK") {
            $data = Practicum::where('license_number', $request->license_number)->first();
            $path = 'storage/document/practicum/' . $data->agency_license;
        }

        if ($data) {
            if (Auth::user()->is_admin == 0) {
                if ($data->user_id == Auth::user()->id) {
                    return view('pdf', [
                        'path' => $path,
                        'service' => $data->license_number,
                    ]);
                } else {
                    return view('errors.404');
                }
            } else {
                return view('pdf', [
                    'path' => $path,
                    'service' => $data->license_number,
                ]);
            }
        } else {
            return view('errors.404');
        }
    }
}
