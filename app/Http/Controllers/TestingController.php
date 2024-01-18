<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\LicenseFooterImage;
use App\Models\LicenseFormat;
use App\Models\LicenseFormatBody;
use App\Models\LicenseFormatDetail;
use App\Models\LicenseLetterhead;
use App\Models\LicenseSignature;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestingController extends Controller
{
    public function test() {
        $id = "990cbde0-3dbe-4e55-bd6e-04daaa90a575";
        $user_id = "2";
        $license_number = "KFSPD202401191";

        $data           = LicenseFormat::where('id', $id)->with(['letterhead', 'footer_image'])->first();
        $letterheads    = LicenseLetterhead::get()->sortBy('created_at');
        $signatures     = LicenseSignature::get()->sortBy('created_at');
        $footer_images  = LicenseFooterImage::get()->sortBy('created_at');
        $service_info   = LicenseFormatDetail::whereNot('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user_info      = LicenseFormatDetail::where('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user           = User::where('id', $user_id)->first();
        $service_data   = Helpers::findDataByLicenseNumber($license_number);
        $body           = LicenseFormatBody::where('license_number', $license_number)->where('license_format_id', $id)->first();
        // $qr = base64_encode(QrCode::format('png')->size(256)->generate(route('verifQR', ['license_number' => $license_number])));

        $raw = [
            'data' => $data,
            'letterheads' => $letterheads,
            'signatures' => $signatures,
            'footer_images' => $footer_images,
            'service_info' => $service_info,
            'user_info' => $user_info,
            'user' => $user,
            'service_data' => $service_data,
            'body' => $body,
            'license_number' => $license_number,
            'status' => 0,
            'isPracticum' => 0,
            'practicumCount' => 1,
            'letterNumber' => 12,
            'letterAttachment' => 12,
            // 'qr' => $qr,
        ];

        return view('test.qrTest', $raw);

        // return view('test.qrTest', [
        //     'license_number' => $license_number
        // ]);
    }
}
