<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VerificationController extends Controller
{
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect('/dashboard')
            : view('auth.verify-email', [
                'active' => 'verify'
            ]);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/dashboard');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', 'Verification link sent!');
    }
}
