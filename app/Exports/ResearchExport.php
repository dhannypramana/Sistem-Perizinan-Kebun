<?php

namespace App\Exports;

use App\Models\Research;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResearchExport implements FromView
{
    public function view(): View
    {
        $research = Research::all();

        return view('services.research.export', [
            'research' => $research,
            'researchCount' => $research->count(),
        ]);
    }
}
