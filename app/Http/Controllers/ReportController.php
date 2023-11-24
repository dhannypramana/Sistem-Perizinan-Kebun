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

    function buildBaseQuery($model, $request)
    {
        $query = $model::whereHas('user', function ($query) use ($request) {
            if ($request->faculty !== 'all_faculty') {
                $query->where('major', '=', $request->faculty);
            }
            if ($request->academic_program !== 'all_academic_program') {
                $query->where('academic_program', '=', $request->academic_program);
            }
        })->with(['user']);

        return $query;
    }

    function applyDateFilter($query, $request)
    {
        if ($request->useDate === 'true') {
            $query->where('created_at', '>=', $request->start_date)
                ->where('created_at', '<=', $request->end_date);
        }

        return $query;
    }

    function applyLocationFilter($query, $request, $locationField, $allLocationField)
    {
        if ($request->$locationField !== $allLocationField) {
            $query->where('location', $request->$locationField);
        }

        return $query;
    }

    function getFilters(Request $request)
    {
        switch ($request->service) {
            case 'penelitian':
                $query = $this->buildBaseQuery(Research::class, $request);
                $query = $this->applyLocationFilter($query, $request, 'researchLocation', 'all_location');
                $query = $this->applyDateFilter($query, $request);
                break;

            case 'permintaanData':
                $query = $this->buildBaseQuery(DataRequest::class, $request);
                $query = $this->applyDateFilter($query, $request);
                break;

            case 'peminjaman':
                $query = $this->buildBaseQuery(Loan::class, $request);
                if ($request->loanCategory !== 'all_category') {
                    if ($request->loanCategory == 'Lain-Lain') {
                        $query->where('category', '<>', 'Ruangan')->where('category', '<>', 'Alat');
                    } else {
                        $query->where('category', $request->loanCategory);
                    }
                }
                $query = $this->applyDateFilter($query, $request);
                break;

            case 'praktikum':
                $query = $this->buildBaseQuery(Practicum::class, $request);
                $query = $this->applyLocationFilter($query, $request, 'practicumLocation', 'all_location_practicum');
                $query = $this->applyDateFilter($query, $request);
                break;

            default:
                return response()->json([
                    'data' => [],
                ]);
        }

        $data = $query->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
