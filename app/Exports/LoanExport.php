<?php

namespace App\Exports;

use App\Models\Loan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LoanExport implements FromView
{
    public function view(): View
    {
        $loan = Loan::all();

        return view('services.loan.export', [
            'loan' => $loan,
            'loanCount' => $loan->count(),
        ]);
    }
}
