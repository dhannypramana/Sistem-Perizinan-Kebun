<?php

namespace App\Http\Controllers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function show()
    {
        return view('report.reports', [
            'active' => 'reports'
        ]);
    }

    function getFilters(Request $request)
    {
        switch ($request->service) {
            case 'penelitian':
                $data = Research::whereHas('user', function ($query) use ($request) {
                    if ($request->faculty !== 'all_faculty') {
                        $query->where('major', '=', $request->faculty);
                    }
                    if ($request->academic_program !== 'all_academic_program') {
                        $query->where('academic_program', '=', $request->academic_program);
                    }
                })->with(['user']);

                if ($request->researchLocation !== 'all_location') {
                    $data = $data->where('location', $request->researchLocation);
                }

                if ($request->useDate === 'true') {
                    $data = $data->where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date);
                }

                $data = $data->get();
                break;
            case 'permintaanData':
                $data = DataRequest::whereHas('user', function ($query) use ($request) {
                    if ($request->faculty !== 'all_faculty') {
                        $query->where('major', '=', $request->faculty);
                    }
                    if ($request->academic_program !== 'all_academic_program') {
                        $query->where('academic_program', '=', $request->academic_program);
                    }
                })->with(['user']);

                if ($request->useDate === 'true') {
                    $data = $data->where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date);
                }

                $data = $data->get();
                break;

            case 'peminjaman':
                $data = Loan::whereHas('user', function ($query) use ($request) {
                    if ($request->faculty !== 'all_faculty') {
                        $query->where('major', '=', $request->faculty);
                    }
                    if ($request->academic_program !== 'all_academic_program') {
                        $query->where('academic_program', '=', $request->academic_program);
                    }
                })->with(['user']);

                if ($request->loanCategory !== 'all_category') {
                    if ($request->loanCategory == 'Lain-Lain') {
                        $data = $data->where('category', '<>', 'Ruangan')->where('category', '<>', 'Alat');
                    } else {
                        $data = $data->where('category', $request->loanCategory);
                    }
                }

                if ($request->useDate === 'true') {
                    $data = $data->where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date);
                }

                $data = $data->get();
                break;

            case 'praktikum':
                $data = Practicum::whereHas('user', function ($query) use ($request) {
                    if ($request->faculty !== 'all_faculty') {
                        $query->where('major', '=', $request->faculty);
                    }
                    if ($request->academic_program !== 'all_academic_program') {
                        $query->where('academic_program', '=', $request->academic_program);
                    }
                })->with(['user']);

                if ($request->practicumLocation !== 'all_location_practicum') {
                    $data = $data->where('location', $request->practicumLocation);
                }

                if ($request->useDate === 'true') {
                    $data = $data->where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date);
                }

                $data = $data->get();
                break;
            default:
                break;
        }
        return response()->json([
            'data' => $data,
        ]);
    }
}
