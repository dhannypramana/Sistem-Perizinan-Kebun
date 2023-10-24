<?php

namespace App\Http\Controllers;

use App\Exports\DataRequestExport;
use App\Exports\LoanExport;
use App\Exports\PracticumExport;
use App\Exports\ResearchExport;
use Maatwebsite\Excel\Facades\Excel;

class RecapController extends Controller
{
    public function exportResearch()
    {
        return Excel::download(new ResearchExport, 'penelitian.xlsx');
    }

    public function exportDataRequest()
    {
        return Excel::download(new DataRequestExport, 'permintaan_data.xlsx');
    }

    public function exportLoan()
    {
        return Excel::download(new LoanExport, 'peminjaman.xlsx');
    }

    public function exportPracticum()
    {
        return Excel::download(new PracticumExport, 'praktikum.xlsx');
    }
}
