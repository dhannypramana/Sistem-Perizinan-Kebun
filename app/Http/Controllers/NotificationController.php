<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class NotificationController extends Controller
{
    public static function sendWhatsapp(Model $model)
    {
        $sid = env("TWILIO_ACCOUNT_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $phone_number = env("TWILIO_PHONE_NUMBER");

        $twilio = new Client($sid, $token);

        $service = Helpers::getService($model->license_number);
        $link = Helpers::getAdminUrl($model->license_number);

        $template = sprintf(
            "Pengajuan Baru Telah Masuk\n\nJenis Pengajuan : %s\nNo Izin : %s\nNama Pengaju : %s\n\nSegera Lakukan Konfirmasi %s",
            $service,
            $model->license_number,
            $model->user->name,
            $link,
        );

        $twilio->messages->create(
            'whatsapp:' . $phone_number,
            [
                'from' => 'whatsapp:+14155238886',
                'body' => $template
            ]
        );
    }
}
