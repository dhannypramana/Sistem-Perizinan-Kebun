<?php

namespace App\Http\Middleware;

use App\Models\DataRequest;
use App\Models\Loan;
use App\Models\Practicum;
use App\Models\Research;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedUser
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
        $service = substr($request->license_number, 3, 2);

        $data = null;

        if ($service == "PL") {
            $data = Research::where('license_number', $request->license_number)->first();
        } else if ($service == "PD") {
            $data = DataRequest::where('license_number', $request->license_number)->first();
        } else if ($service == "PS") {
            $data = Loan::where('license_number', $request->license_number)->first();
        } else if ($service == "PK") {
            $data = Practicum::where('license_number', $request->license_number)->first();
        }

        if ($data) {
            if (Auth::user()->role == 'user') {
                if ($data->user_id == Auth::user()->id) {
                    return $next($request);
                } else {
                    return response()->view('errors.404');
                }
            } else {
                return $next($request);
            }
        }

        return response()->view('errors.404');
    }
}
