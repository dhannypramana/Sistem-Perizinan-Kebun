<?php

namespace App\Http\Controllers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function show($license_number) {
        $service = substr($license_number, 3,2);
        $data = null;
        $layananPengajuan = null;

        switch ($service) {
            case 'PL':
                $data = Research::where('license_number', $license_number)->with('user')->first();
                $layananPengajuan = "Penelitian";
                break;
            case 'PD':
                $data = DataRequest::where('license_number', $license_number)->with('user')->first();
                $layananPengajuan = "Permintaan Data";
                break;
            case 'PS':
                $data = Loan::where('license_number', $license_number)->with('user')->first();
                $layananPengajuan = "Peminjaman";
                break;
            case 'PK':
                $data = Practicum::where('license_number', $license_number)->with('user')->first();
                $layananPengajuan = "Praktikum";
                break;
            default:
                return view('errors.404');
                break;
        }

        return view('services.license.verified', [
            'license_number' => $license_number,
            'data' => $data,
            'layananPengajuan' => $layananPengajuan,
        ]);
    }
}
