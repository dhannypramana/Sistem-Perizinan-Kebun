<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Mail\UserNotificationMail;
use App\Models\DataRequest;
use App\Models\LicenseFooterImage;
use App\Models\LicenseFormat;
use App\Models\LicenseFormatBody;
use App\Models\LicenseFormatDetail;
use App\Models\LicenseLetterhead;
use App\Models\LicenseSignature;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ConfirmationController extends Controller
{
    public static function getService($license_number)
    {
        $service = substr($license_number, 3, 2);

        if ($service == "PL") {
            $data = Research::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PD") {
            $data = DataRequest::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PS") {
            $data = Loan::where('license_number', $license_number)->first();
            return $data;
        } else if ($service == "PK") {
            $data = Practicum::where('license_number', $license_number)->get();
            return $data;
        }
    }

    public static function generateReply($id, $user_id, $license_number, $status, $letterNumber, $letterAttachment)
    {
        $data           = LicenseFormat::where('id', $id)->with(['letterhead', 'footer_image'])->first();
        $letterheads    = LicenseLetterhead::get()->sortBy('created_at');
        $signatures     = LicenseSignature::get()->sortBy('created_at');
        $footer_images  = LicenseFooterImage::get()->sortBy('created_at');
        $service_info   = LicenseFormatDetail::whereNot('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user_info      = LicenseFormatDetail::where('info_type', 'user')->where('license_format_id', $id)->get()->sortBy('created_at');
        $user           = User::where('id', $user_id)->first();
        $service_data   = Helpers::findDataByLicenseNumber($license_number);
        $body           = LicenseFormatBody::where('license_number', $license_number)->where('license_format_id', $id)->first();

        $isPracticum = null;
        $practicumCount = 0;

        if ($service_data instanceof \Illuminate\Database\Eloquent\Collection && $service_data->isNotEmpty()) {
            $isPracticum = true;
            $practicumCount = $service_data->count();
        } else {
            $isPracticum = false;
        }

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
            'status' => $status,
            'isPracticum' => $isPracticum,
            'practicumCount' => $practicumCount,
            'letterNumber' => $letterNumber,
            'letterAttachment' => $letterAttachment,
        ];

        $fileName =  'reply_' . $license_number . '.pdf';
        $pdf = Pdf::loadView('template.response', $raw);
        $content = $pdf->download()->getOriginalContent();
        $path = 'public/document/reply/';
        $service = ConfirmationController::getService($license_number);

        if (substr($license_number, 3, 2) == 'PK') {
            $path .= 'practicum/';
            foreach ($service as $s) {
                $s->update([
                    'reply' => $fileName,
                ]);
            }
        } else {
            if (substr($license_number, 3, 2) == 'PL') {
                $path .= 'research/';
            } else if (substr($license_number, 3, 2) == 'PD') {
                $path .= 'data_request/';
            } else if (substr($license_number, 3, 2) == 'PS') {
                $path .= 'loan/';
            }

            $service->update([
                'reply' => $fileName,
            ]);
        }

        Storage::makeDirectory($path);
        Storage::put($path . $fileName, $content);
    }

    public static function accept(Request $request)
    {
        try {
            ConfirmationController::generateReply($request->id, $request->user_id, $request->license_number, $request->status,
             $request->letter_number, $request->letter_attachment);
        } catch (\Throwable $th) {
            throw $th;
        }

        $service = ConfirmationController::getService($request->license_number);
        $url = '/admin';

        if (substr($request->license_number, 3, 2) == 'PK') {
            foreach ($service as $s) {
                $s->update([
                    'is_reviewed' => true,
                    'status' => $request->status,
                ]);

                if ($request->status == '2') {
                    $s->update([
                        'admin_message' => $request->admin_message
                    ]);
                }
            }

            $url = $url . '/practicum/check/' . $request->license_number;
        } else {
            if (substr($request->license_number, 3, 2) == 'PL') {
                $url = $url . '/research/check/' . $request->license_number;
            } else if (substr($request->license_number, 3, 2) == 'PD') {
                $url = $url . '/data/check/' . $request->license_number;
            } else {
                $url = $url . '/loan/check/' . $request->license_number;
            }

            $service->update([
                'is_reviewed' => true,
                'status' => $request->status,
            ]);

            if ($request->status == '2') {
                $service->update([
                    'admin_message' => $request->admin_message
                ]);
            }
            /**
             * Send Email Confirmation to User
             */
            Mail::to($service->user->email)->send(new UserNotificationMail($service, Helpers::getService($service->license_number)));
        }

        return Redirect::to($url)->with('status', 'Sukses Konfirmasi Pengajuan!');
    }

    // public static function reject(Request $request)
    // {
    //     $service = ConfirmationController::getService($request->license_number);

    //     if (substr($request->license_number, 3, 2) == 'PK') {
    //         foreach ($service as $s) {
    //             $s->update([
    //                 'is_reviewed' => true,
    //                 'status' => 'Ditolak',
    //                 'admin_message' => $request->admin_message,
    //             ]);
    //         }
    //     } else {
    //         $service->update([
    //             'is_reviewed' => true,
    //             'status' => 'Ditolak',
    //             'admin_message' => $request->admin_message,
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => 'Berhasil Menolak Ajuan!',
    //     ]);
    // }
}
