<?php

namespace App\Helpers;

class Helpers
{
    public static function generateLicenseNumber($service, $time, $number)
    {
        $day = date('d', strtotime($time));
        $month = date('m', strtotime($time));
        $year = date('Y', strtotime($time));

        $license_number = "KFS{$service}{$year}{$month}{$day}{$number}";

        return $license_number;
    }
}
