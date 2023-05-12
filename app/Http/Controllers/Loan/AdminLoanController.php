<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    public static function check()
    {
        return view('services.loan.check', [
            'active' => 'loan_check',
            'loan' => Loan::latest()->paginate(4)
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
}
