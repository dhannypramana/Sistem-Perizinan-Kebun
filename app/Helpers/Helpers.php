<?php

namespace App\Helpers;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Illuminate\Database\Eloquent\Model;

class Helpers
{
    public static function findDataByLicenseNumber($license_number)
    {
        $code = substr($license_number, 3, 2);

        $data = null;

        if ($code == 'PL') {
            $data = Research::where('license_number', $license_number)->get();
        } else if ($code == 'PD') {
            $data = DataRequest::where('license_number', $license_number)->first();
        } else if ($code == 'PS') {
            $data = Loan::where('license_number', $license_number)->get();
        } else if ($code == 'PK') {
            $data = Practicum::where('license_number', $license_number)->get();
        }

        return $data;
    }

    public static function generateLicenseNumber($service, $time, $number)
    {
        $day = date('d', strtotime($time));
        $month = date('m', strtotime($time));
        $year = date('Y', strtotime($time));

        $license_number = "KFS{$service}{$year}{$month}{$day}{$number}";

        return $license_number;
    }

    public static function getService($license_number)
    {
        $code = substr($license_number, 3, 2);

        $service = null;

        if ($code == 'PL') {
            $service = 'Penelitian';
        } else if ($code == 'PD') {
            $service = 'Permintaan Data';
        } else if ($code == 'PS') {
            $service = 'Peminjaman Sarana dan Prasarana';
        } else if ($code == 'PK') {
            $service = 'Praktikum';
        }

        return $service;
    }

    public static function getAdminUrl($license_number)
    {
        $code = substr($license_number, 3, 2);

        $url = env("APP_URL") . '/admin/';

        if ($code == 'PL') {
            $url = $url . 'research/';
        } else if ($code == 'PD') {
            $url = $url . 'data/';
        } else if ($code == 'PS') {
            $url = $url . 'loan/';
        } else if ($code == 'PK') {
            $url = $url . 'practicum/';
        }

        $url = $url . 'check/' . $license_number;

        return $url;
    }
}
