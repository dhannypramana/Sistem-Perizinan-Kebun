<?php

namespace App\Http\Controllers\Practicum;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Practicum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserPracticumController extends Controller
{
    public static function proposal()
    {
        return view('services.practicum.proposal', [
            'active' => 'practicum_proposal',
        ]);
    }

    public function check()
    {
        return view('services.practicum.check', [
            'active' => 'practicum_check',
            'practicum' => Practicum::where('user_id', auth()->user()->id)
                ->select('license_number', 'created_at', 'status',)
                ->distinct()
                ->latest()
                ->get(),
        ]);
    }

    public function details(Request $request)
    {
        $practicum = Practicum::where('license_number', $request->license_number)->get();

        return view('services.practicum.details', [
            'active' => 'practicum_details',
            'practicum' => $practicum,
        ]);
    }

    public static function store(Request $request)
    {
        if ($request->count == 0) {
            return response()->json([
                'status' => 1,
                'err_type' => 'no_subject',
                'errors' => "Minimal terdapat 1 mata kuliah!"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'agency_license' => ['required', 'file', 'mimes:pdf', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        for ($i = 1; $i <= $request->count; $i++) {
            $validator = Validator::make($request->all(), [
                'location' . $i => ['required'],
                'personnel' . $i => ['required', 'numeric', 'min:1'],
                'practicum_supervisor' . $i => ['required', 'min:3'],
                'assistant' . $i => ['required', 'min:3'],
                'subject' . $i => ['required'],
                'class_supervisor' . $i => ['min:3'],
                'facility' . $i => ['required'],
                'start_time' . $i => ['required', 'date'],
                'end_time' . $i => ['required', 'date', 'after_or_equal:' . 'start_time' . $i],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 1,
                    'errors' => $validator->errors()
                ]);
            }

            $practicum = Practicum::create([
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,

                'location' => $request['location' . $i],
                'personnel' => $request['personnel' . $i],
                'practicum_supervisor' => $request['practicum_supervisor' . $i],
                'assistant' => $request['assistant' . $i],
                'subject' => $request['subject' . $i],
                'class_supervisor' => $request['class_supervisor' . $i],
                'facility' => $request['facility' . $i],
                'start_time' => $request['start_time' . $i],
                'end_time' => $request['end_time' . $i],
            ]);

            if ($i == 1) {
                $license_number = Helpers::generateLicenseNumber('PK', $practicum->created_at, $practicum->practicum_number);

                if ($request->hasFile('agency_license')) {
                    $extension      = $request->file('agency_license')->extension();
                    $fileName        = $license_number . '.'  . $extension;

                    Storage::putFileAs('public/document/practicum', $request->file('agency_license'), $fileName);
                }
            }

            $practicum->update([
                'license_number' => $license_number,
                'agency_license' => $fileName
            ]);

            if ($i == $request->count) {
                NotificationController::sendWhatsapp($practicum);
                NotificationController::sendEmail($practicum);
            }
        }

        return response()->json([
            'success' => 'Terima Kasih Atas Feedback Kamu, Pengajuan Kamu Akan Segera di Review',
        ]);
    }
}
