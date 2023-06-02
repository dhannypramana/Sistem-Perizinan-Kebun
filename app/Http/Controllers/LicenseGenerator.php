<?php

namespace App\Http\Controllers;

use App\Models\LicenseFormat;
use App\Models\LicenseFormatDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicenseGenerator extends Controller
{
    public static function show()
    {
        $license_formats = LicenseFormat::get();

        return view('services.license.option_format', [
            'active' => 'template',
            'license_formats' => $license_formats
        ]);
    }

    public static function details($id)
    {
        $data = LicenseFormat::find($id);

        return view('services.license.details_format', [
            'active' => 'template',
            'data' => $data
        ]);
    }

    public function tolol(Request $tolol)
    {
        // return LicenseFormatDetail::create([
        //     'id' => Str::uuid(),
        //     'type' => $tolol->type,
        //     'license_format_id' => $tolol->license_format_id
        // ]);

        for ($i = 0; $i < count($tolol->type); $i++) {
            LicenseFormatDetail::create([
                'id' => Str::uuid(),
                'type' => $tolol->type[$i],
                'license_format_id' => $tolol->license_format_id
            ]);
        }

        return "success anjeng";
    }

    // public static function research()
    // {
    //     return view('services.license.format_research', [
    //         'active' => 'template',
    //     ]);
    // }

    // public static function data()
    // {
    //     return view('services.license.format_data', [
    //         'active' => 'template',
    //     ]);
    // }
    // public static function loan()
    // {
    //     return view('services.license.format_loan', [
    //         'active' => 'template',
    //     ]);
    // }
    // public static function practicum()
    // {
    //     return view('services.license.format_practicum', [
    //         'active' => 'template',
    //     ]);
    // }
}
