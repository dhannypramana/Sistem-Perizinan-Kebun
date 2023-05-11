<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->name == null || $user->address == null || $user->academic_program == null || $user->student_number == null || $user->phone_number == null) {
            Alert::warning('Oopss...', 'Profil Belum Lengkap! Silahkan Lengkapi Profil Terlebih Dahulu!')->persistent(true)->autoClose(5000);
            return redirect()->route('profile');
        } else {
            return $next($request);
        }
    }
}
