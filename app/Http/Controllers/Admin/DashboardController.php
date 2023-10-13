<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function show()
    {
        $researchCount = Research::get()->count();
        $dataRequestCount = DataRequest::get()->count();
        $loanCount = Loan::get()->count();
        $practicumCount = Practicum::select('license_number', 'created_at', 'status',)
            ->distinct()
            ->latest()
            ->get()
            ->count();
        $reviewedResearchCount = Research::where('is_reviewed', true)->get()->count();
        $reviewedDataRequestCount = DataRequest::where('is_reviewed', true)->get()->count();
        $reviewedLoanCount = Loan::where('is_reviewed', true)->get()->count();
        $reviewedPracticumCount = Practicum::where('is_reviewed', true)
            ->select('license_number', 'created_at', 'status',)
            ->distinct()
            ->get()
            ->count();

        $reviewedResearchPercentage = 0;
        if ($researchCount == 0) {
            $reviewedResearchPercentage = 0;
        } else {
            $reviewedResearchPercentage = round(($reviewedResearchCount / $researchCount) * 100, 1);
        }

        $reviewedDataRequestPercentage = 0;
        if ($dataRequestCount == 0) {
            $reviewedDataRequestPercentage = 0;
        } else {
            $reviewedDataRequestPercentage = round(($reviewedDataRequestCount / $dataRequestCount) * 100, 1);
        }

        $reviewedLoanPercentage = 0;
        if ($loanCount == 0) {
            $reviewedLoanPercentage = 0;
        } else {
            $reviewedLoanPercentage = round(($reviewedLoanCount / $loanCount) * 100, 1);
        }

        $reviewedPracticumPercentage = 0;
        if ($practicumCount == 0) {
            $reviewedPracticumPercentage = 0;
        } else {
            $reviewedPracticumPercentage = round(($reviewedPracticumCount / $practicumCount) * 100, 1);
        }

        return view('admin.dashboard', [
            'active' => 'dashboard',
            'researchCount' => $researchCount,
            'dataRequestCount' => $dataRequestCount,
            'loanCount' => $loanCount,
            'practicumCount' => $practicumCount,

            'reviewedResearchPercentage' => $reviewedResearchPercentage,
            'reviewedDataRequestPercentage' => $reviewedDataRequestPercentage,
            'reviewedLoanPercentage' => $reviewedLoanPercentage,
            'reviewedPracticumPercentage' => $reviewedPracticumPercentage,
        ]);
    }
}
