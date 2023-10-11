<?php

namespace App\Http\Controllers\DataRequest;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\DataRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserDataRequestController extends Controller
{
    public static function proposal()
    {
        return view('services.data_request.proposal', [
            'active' => 'data_request_proposal',
            'user' => auth()->user()
        ]);
    }

    public static function check()
    {
        return view('services.data_request.check', [
            'active' => 'data_request_check',
            'data_request' => DataRequest::where('user_id', auth()->user()->id)->latest()->get()
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

    public static function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => ['required', 'min:3'],
            'title' => ['required', 'min:3'],
            'purpose' => ['required', 'min:3'],
            'agency' => ['required', 'min:3'],
            'agency_license' => ['required', 'file', 'mimes:pdf', 'max:1025'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $data = DataRequest::create([
            'id' => Str::uuid(),
            'user_id' => auth()->user()->id,

            'category' => $request->category,
            'title' => $request->title,
            'purpose' => $request->purpose,
            'agency' => $request->agency
        ]);

        $license_number = Helpers::generateLicenseNumber('PD', $data->created_at, $data->data_number);

        if ($request->hasFile('agency_license')) {
            $extension      = $request->file('agency_license')->extension();
            $fileName        = $license_number . '.'  . $extension;

            Storage::putFileAs('public/document/data_request', $request->file('agency_license'), $fileName);
        }

        $data->update([
            'license_number' => $license_number,
            'agency_license' => $fileName
        ]);

        /**
         * Send Proposal Notification to Admin
         */
        NotificationController::sendWhatsapp($data);
        NotificationController::sendEmail($data);

        return response()->json([
            'success' => 'Terima Kasih Atas Feedback Kamu, Pengajuan Kamu Akan Segera di Review',
        ]);
    }
}
