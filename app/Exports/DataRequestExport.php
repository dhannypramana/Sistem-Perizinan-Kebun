<?php

namespace App\Exports;

use App\Models\DataRequest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataRequestExport implements FromView
{
    public function view(): View
    {
        $dataRequest = DataRequest::all();

        return view('services.data_request.export', [
            'dataRequest' => $dataRequest,
            'dataRequestCount' => $dataRequest->count(),
        ]);
    }
}
