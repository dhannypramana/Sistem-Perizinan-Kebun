<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataRequest\AdminDataRequestController;
use App\Http\Controllers\DataRequest\UserDataRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Loan\AdminLoanController;
use App\Http\Controllers\Loan\UserLoanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Practicum\AdminPracticumController;
use App\Http\Controllers\Practicum\UserPracticumController;
use App\Http\Controllers\Research\AdminResearchController;
use App\Http\Controllers\Research\UserResearchController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Testing Routes


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{license_number}/pdf', [PdfController::class, 'index'])->name('agency_license');

Route::middleware('guest')->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('/', [LoginController::class, 'show'])->name('login');
        Route::post('/', [LoginController::class, 'login']);
    });

    Route::prefix('/register')->group(function () {
        Route::get('/', [RegisterController::class, 'show'])->name('register');
        Route::post('/', [RegisterController::class, 'register']);
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout']);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('user_dashboard');

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::post('/', [ProfileController::class, 'edit']);
    });

    Route::middleware('complete_profile')->group(function () {
        Route::prefix('/research')->group(function () {
            route::get('/', [UserResearchController::class, 'proposal'])->name('research_proposal');
            route::post('/', [UserResearchController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserResearchController::class, 'check'])->name('research_check');
                route::get('/{license_number}', [UserResearchController::class, 'details'])->name('research_details');
            });
        });

        Route::prefix('/data')->group(function () {
            route::get('/', [UserDataRequestController::class, 'proposal'])->name('data_request_proposal');
            route::post('/', [UserDataRequestController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserDataRequestController::class, 'check'])->name('data_request_check');
                route::get('/{license_number}', [UserDataRequestController::class, 'details'])->name('data_request_details');
            });
        });

        Route::prefix('/loan')->group(function () {
            route::get('/', [UserLoanController::class, 'proposal'])->name('loan_proposal');
            route::post('/', [UserLoanController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserLoanController::class, 'check'])->name('loan_check');
                route::get('/{license_number}', [UserLoanController::class, 'details'])->name('loan_details');
            });
        });

        Route::prefix('/practicum')->group(function () {
            route::get('/', [UserPracticumController::class, 'proposal'])->name('practicum_proposal');
            route::post('/', [UserPracticumController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserPracticumController::class, 'check'])->name('practicum_check');
                route::get('/{license_number}', [UserPracticumController::class, 'details'])->name('practicum_details');
            });
        });
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'show'])->name('admin_dashboard');

        Route::prefix('/research')->group(function () {
            Route::prefix('/check')->group(function () {
                Route::get('/', [AdminResearchController::class, 'check'])->name('admin_research_check');
                route::get('/{license_number}', [AdminResearchController::class, 'details'])->name('admin_research_details');
            });
        });

        Route::prefix('/data')->group(function () {
            Route::prefix('/check')->group(function () {
                Route::get('/', [AdminDataRequestController::class, 'check'])->name('admin_data_request_check');
                route::get('/{license_number}', [AdminDataRequestController::class, 'details'])->name('admin_data_request_details');
            });
        });

        Route::prefix('/loan')->group(function () {
            Route::prefix('/check')->group(function () {
                Route::get('/', [AdminLoanController::class, 'check'])->name('admin_loan_check');
                route::get('/{license_number}', [AdminLoanController::class, 'details'])->name('admin_loan_details');
            });
        });

        Route::prefix('/practicum')->group(function () {
            Route::prefix('/check')->group(function () {
                Route::get('/', [AdminPracticumController::class, 'check'])->name('admin_practicum_check');
                route::get('/{license_number}', [AdminPracticumController::class, 'details'])->name('admin_practicum_details');
            });
        });
    });
});
