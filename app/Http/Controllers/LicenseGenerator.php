<?php

namespace App\Http\Controllers;

use App\Models\LicenseFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicenseGenerator extends Controller
{
    public static function show()
    {
        $formats = LicenseFormat::get();

        return view('services.license.option_format', [
            'active' => 'template',
            'formats' => $formats
        ]);
    }

    public static function store(Request $request)
    {
        $license = LicenseFormat::create([
            'id' => Str::uuid(),
            'format_title' => $request->format_title
        ]);

        return response()->json([
            'status' => 'Success',
        ]);
    }

    public static function update(Request $request)
    {
        $license = LicenseFormat::find($request->id);
        $license->update($request->all());

        return response()->json([
            'status' => 'Success',
            'license' => $license,
        ]);
    }

    public static function destroy(Request $request)
    {
        $format = LicenseFormat::find($request->id);
        $format->delete();

        return response()->json([
            'status' => 0,
            'success' => 'Berhasil Menghapus Format'
        ]);
    }

    public static function research()
    {
        return view('services.license.format_research', [
            'active' => 'template',
        ]);
    }

    public static function data()
    {
        return view('services.license.format_data', [
            'active' => 'template',
        ]);
    }
    public static function loan()
    {
        return view('services.license.format_loan', [
            'active' => 'template',
        ]);
    }
    public static function practicum()
    {
        return view('services.license.format_practicum', [
            'active' => 'template',
        ]);
    }
}
