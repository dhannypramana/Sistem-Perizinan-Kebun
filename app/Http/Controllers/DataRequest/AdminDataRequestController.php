<?php

namespace App\Http\Controllers\DataRequest;

use App\Http\Controllers\Controller;
use App\Models\DataRequest;
use Illuminate\Http\Request;

class AdminDataRequestController extends Controller
{
    public static function check()
    {
        return view('services.data_request.check', [
            'active' => 'data_request_check',
            'data_request' => DataRequest::latest()->paginate(4)
        ]);
    }

    public static function details(Request $request)
    {
        $data_request = DataRequest::where('license_number', $request->license_number)->first();

        return view('services.data_request.details', [
            'active' => 'data_request_check',
            'data_request' => $data_request,
        ]);
    }
}
