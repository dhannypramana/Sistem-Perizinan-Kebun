<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\LicenseFormat;
use App\Models\LicenseFormatBody;
use App\Models\LicenseFormatDetail;
use App\Models\LicenseFormatMeta;
use App\Models\LicenseFormatMetaHeader;
use App\Models\LicenseFormatService;
use App\Models\LicenseLetterhead;
use App\Models\LicenseSignature;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Extension\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LicenseGenerator extends Controller
{
    public static function show()
    {
        $license_formats = LicenseFormat::get()->sortBy('created_at');

        return view('services.license.option_format', [
            'active' => 'template',
            'license_formats' => $license_formats
        ]);
    }

    public static function getLicenseFormat()
    {
        $license_formats = LicenseFormat::get()->sortBy('created_at');

        return response()->json([
            'message' => 'Success get data',
            'data' => $license_formats
        ]);
    }

    public static function getLicenseFormatByID($id)
    {
        return response()->json($id);
    }

    public static function store(Request $request)
    {
        LicenseFormat::create([
            'format_title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Berhasil menambah data template surat',
        ]);
    }

    public static function details($id)
    {
        $data = LicenseFormat::where('id', $id)->with(['letterhead', 'signature'])->first();
        $letterheads = LicenseLetterhead::get()->sortBy('created_at');
        $signatures = LicenseSignature::get()->sortBy('created_at');
        $service_info = LicenseFormatDetail::whereNot('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user_info = LicenseFormatDetail::where('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');

        return view('services.license.details_format', [
            'active' => 'template',
            'data' => $data,
            'letterheads' => $letterheads,
            'signatures' => $signatures,
            'service_info' => $service_info,
            'user_info' => $user_info,
        ]);
    }

    public static function detailsTemplate($id, $user_id, $license_number)
    {
        $data = LicenseFormat::where('id', $id)->with(['letterhead', 'signature'])->first();
        $service_info = LicenseFormatDetail::whereNot('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user_info = LicenseFormatDetail::where('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user = User::where('id', $user_id)->first();
        $service_data = Helpers::findDataByLicenseNumber($license_number);
        $body = LicenseFormatBody::where('license_number', $license_number)->where('license_format_id', $id)->first();
        $countServiceData = $service_data->count();

        return view('services.license.template', [
            'active' => 'a',
            'data' => $data,
            'service_info' => $service_info,
            'user_info' => $user_info,
            'user' => $user,
            'service_data' => $service_data,
            'license_number' => $license_number,
            'body' => $body,
            'countServiceData' => $countServiceData,
        ]);
    }

    public static function update(Request $request)
    {
        $data = LicenseFormat::find($request->id);

        $data->update([
            'format_title' => $request->title
        ]);

        return response()->json([
            'message' => 'Sukses memperbarui template'
        ]);
    }

    public static function updateKop(Request $request)
    {
        $data = LicenseFormat::find($request->license_format_id);

        $data->update([
            'license_letterhead_id' => $request->license_type_id
        ]);

        return response()->json([
            'success' => 'Sukses mengganti kop surat',
        ]);
    }

    public static function updateSignature(Request $request)
    {
        $data = LicenseFormat::find($request->license_format_id);

        $data->update([
            'license_signature_id' => $request->license_type_id
        ]);

        return response()->json([
            'success' => 'Sukses mengganti tanda tangan surat',
        ]);
    }

    public static function deleteKop(Request $request)
    {
        $license_format = LicenseFormat::where('license_letterhead_id', $request->license_type_id)->get();
        $letterhead = LicenseLetterhead::find($request->license_type_id);

        foreach ($license_format as $ls) {
            $ls->update([
                'license_letterhead_id' => null
            ]);
        }

        $isDeleted = Storage::disk('public')->delete('image/' . $letterhead->letterhead);
        if ($isDeleted) {
            $letterhead->delete();
        } else {
            return response()->json([
                'status' => 1,
                'err' => 'Gagal menghapus kop surat',
            ]);
        }

        return response()->json([
            'success' => 'Sukses menghapus kop surat',
        ]);
    }

    public static function deleteSignature(Request $request)
    {
        $license_format = LicenseFormat::where('license_signature_id', $request->license_type_id)->get();
        $signature = LicenseSignature::find($request->license_type_id);

        foreach ($license_format as $ls) {
            $ls->update([
                'license_signature_id' => null
            ]);
        }

        $isDeleted = Storage::disk('public')->delete('image/' . $signature->signature);

        if ($isDeleted) {
            $signature->delete();
        } else {
            return response()->json([
                'status' => 1,
                'err' => 'Gagal menghapus tanda tangan surat',
            ]);
        }

        return response()->json([
            'success' => 'Sukses menghapus tanda tangan surat',
        ]);
    }

    public function saveTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'letterhead' => ['file', 'mimes:jpg,jpeg,png', 'max:1025'],
            'signature' => ['file', 'mimes:jpg,jpeg,png', 'max:1025'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $data = LicenseFormat::find($request->license_format_id);

        if ($request->hasFile('letterhead')) {
            $extension      = $request->file('letterhead')->extension();
            $fileName        = 'kop_' . time() . date('dmyHis') . rand() . '.'  . $extension;

            Storage::putFileAs('public/image', $request->file('letterhead'), $fileName);

            $lh = LicenseLetterhead::create([
                'id' => Str::uuid(),
                'letterhead' => $fileName,
            ]);

            $data->update([
                'license_letterhead_id' => $lh->id,
            ]);
        }

        if ($request->hasFile('signature')) {
            $extension      = $request->file('signature')->extension();
            $fileName        = 'signature_' . time() . date('dmyHis') . rand() . '.'  . $extension;

            Storage::putFileAs('public/image', $request->file('signature'), $fileName);

            $ls = LicenseSignature::create([
                'id' => Str::uuid(),
                'signature' => $fileName
            ]);

            $data->update([
                'license_signature_id' => $ls->id,
            ]);
        }

        $data->update([
            'title' => $request->title,
            'signed' => $request->signed,
            'nip' => $request->nip,
            'footer' => $request->footer,
        ]);

        /**
         * Save User Info
         */

        return response()->json([
            'success' => 'Sukses memperbarui template surat!',
        ]);
    }
}
