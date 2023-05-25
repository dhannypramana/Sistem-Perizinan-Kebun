<?php

namespace App\Http\Controllers\Loan;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserLoanController extends Controller
{
    public static function proposal()
    {
        return view('services.loan.proposal', [
            'active' => 'loan_proposal',
            'user' => auth()->user()
        ]);
    }

    public static function check()
    {
        return view('services.loan.check', [
            'active' => 'loan_check',
            'loan' => Loan::where('user_id', auth()->user()->id)->latest()->paginate(4)
        ]);
    }

    public static function details(Request $request)
    {
        $loan = Loan::where('license_number', $request->license_number)->first();

        $toDate = Carbon::parse($loan->start_time);
        $fromDate = Carbon::parse($loan->end_time);

        return view('services.loan.details', [
            'active' => 'loan_check',
            'loan' => $loan,
            'loan_time' => $toDate->diffInDays($fromDate),
        ]);
    }

    public function store(Request $request)
    {
        $category = null;

        if ($request->category == "other") {
            $category = $request->other_category;
        } else {
            $category = $request->category;
        }

        $validator = Validator::make($request->all(), [
            'category' => ['required'],
            'title' => ['required'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'activity' => ['required'],
            'purpose' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required', 'date', 'after_or_equal:waktu_mulai'],
            'agency_license' => ['required', 'file', 'mimes:pdf', 'max:1025'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $loan = Loan::create([
            'id' => Str::uuid(),
            'user_id' => auth()->user()->id,

            'category' => $category,
            'title' => $request->title,
            'quantity' => $request->quantity,
            'activity' => $request->activity,
            'purpose' => $request->purpose,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        $license_number = Helpers::generateLicenseNumber('PS', $loan->created_at, $loan->loan_number);

        if ($request->hasFile('agency_license')) {
            $extension      = $request->file('agency_license')->extension();
            $fileName        = $license_number . '.'  . $extension;

            Storage::putFileAs('public/document/loan', $request->file('agency_license'), $fileName);
        }

        $loan->update([
            'license_number' => $license_number,
            'agency_license' => $fileName
        ]);

        NotificationController::sendWhatsapp($loan);

        return response()->json([
            'success' => 'Terima Kasih Atas Feedback Kamu, Pengajuan Kamu Akan Segera di Review',
        ]);
    }
}
