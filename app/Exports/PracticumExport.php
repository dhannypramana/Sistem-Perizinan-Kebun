<?php

namespace App\Exports;

use App\Models\Practicum;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PracticumExport implements FromView
{
    public function view(): View
    {
        $practicum = Practicum::all();

        return view('services.practicum.export', [
            'practicum' => $practicum,
            'practicumCount' => $practicum->count(),
        ]);
    }
}
