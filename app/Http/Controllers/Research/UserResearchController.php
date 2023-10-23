<?php

namespace App\Http\Controllers\Research;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Research;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserResearchController extends Controller
{
    public static function proposal()
    {
        return view('services.research.proposal', [
            'active' => 'research_proposal',
            'user' => auth()->user()
        ]);
    }

    public static function check()
    {
        return view('services.research.check', [
            'active' => 'research_check',
            'research' => Research::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    public static function details(Request $request)
    {
        $research = Research::where('license_number', $request->license_number)->first();

        $toDate = Carbon::parse($research->start_time);
        $fromDate = Carbon::parse($research->end_time);

        return view('services.research.details', [
            'active' => 'research_check',
            'research' => $research,
            'research_time' => $toDate->diffInDays($fromDate),
        ]);
    }

    public static function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['required'],
            'personnel' => ['required', 'numeric', 'min:1'],
            'title' => ['required', 'min:5'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'facility' => ['required'],
            'research_supervisor' => ['required', 'min:3'],
            'academic_supervisor' => ['required', 'min:3'],
            'agency_license' => ['required', 'file', 'mimes:pdf', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $research = Research::create([
            'id' => Str::uuid(),
            'user_id' => auth()->user()->id,
            'location' => $request->location,
            'personnel' => $request->personnel,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'facility' => $request->facility,
            'research_supervisor' => $request->research_supervisor,
            'academic_supervisor' => $request->academic_supervisor,
        ]);

        $license_number = Helpers::generateLicenseNumber('PL', $research->created_at, $research->research_number);

        if ($request->hasFile('agency_license')) {
            $extension      = $request->file('agency_license')->extension();
            $fileName        = $license_number . '.'  . $extension;

            Storage::putFileAs('public/document/research', $request->file('agency_license'), $fileName);
        }

        $research->update([
            'license_number' => $license_number,
            'agency_license' => $fileName
        ]);

        /**
         * If Success create research proposal
         * send notification through whatsapp to admin
         */

        NotificationController::sendWhatsapp($research);
        NotificationController::sendEmail($research);

        return response()->json([
            'success' => 'Terima Kasih Atas Feedback Kamu, Pengajuan Kamu Akan Segera di Review',
        ]);
    }
}
