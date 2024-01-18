<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\DataRequest\AdminDataRequestController;
use App\Http\Controllers\DataRequest\UserDataRequestController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenseFormatBodyController;
use App\Http\Controllers\LicenseFormatServiceController;
use App\Http\Controllers\LicenseFormatUserController;
use App\Http\Controllers\LicenseGenerator;
use App\Http\Controllers\Loan\AdminLoanController;
use App\Http\Controllers\Loan\UserLoanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Practicum\AdminPracticumController;
use App\Http\Controllers\Practicum\UserPracticumController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Research\AdminResearchController;
use App\Http\Controllers\Research\UserResearchController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Mail\DemoMail;
use App\Models\DataRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// use NotificationChannels\WhatsApp\Component;
// use NotificationChannels\WhatsApp\WhatsAppChannel;
// use NotificationChannels\WhatsApp\WhatsAppTemplate;

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

/**
 * Test Routes
 */

Route::get('/test', [TestingController::class, 'test'])->name('test');

/**
 * QR Routes
 */

Route::get('/perizinan/verif/{license_number}', [QrController::class, 'show'])->name('verifQR');

/**
 * Main Routes
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news', [HomeController::class, 'news'])->name('newsHome');
Route::get('/news/{id}', [HomeController::class, 'details'])->name('detailsNewsHome');
Route::get('/{license_number}/pdf', [PdfController::class, 'index'])->name('agency_license');
Route::get('/{license_number}/reply', [PdfController::class, 'reply'])->name('reply_license');

/**
 * Verification Routes
 */
Route::get('/email/verify', [VerificationController::class, 'show'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/**
 * Auth Routes
 */

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

Route::get('/getFaculties', [FacultyController::class, 'getFaculties'])->name('getFaculties');
Route::get('/getAcademicPrograms', [FacultyController::class, 'getAcademicPrograms'])->name('getAcademicPrograms');
Route::get('/get-location', [LocationController::class, 'getLocation'])->name('getLocation');

/**
 * User Routes
 */

Route::middleware(['auth', 'user', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('user_dashboard');

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'showEdit'])->name('edit_profile');
        Route::post('/edit', [ProfileController::class, 'edit']);
        Route::post('/change-photo', [ProfileController::class, 'changePhoto'])->name('change_photo');
        Route::post('/delete-photo', [ProfileController::class, 'deleteUserPhoto'])->name('delete_user_photo');
    });

    Route::middleware(['complete_profile', 'ownership'])->group(function () {
        Route::prefix('/research')->group(function () {
            route::get('/', [UserResearchController::class, 'proposal'])->name('research_proposal');
            route::post('/', [UserResearchController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserResearchController::class, 'check'])->name('research_check');
                route::get('/{license_number}', [UserResearchController::class, 'details'])->name('research_details')->middleware('authenticated_user');
            });
        });

        Route::prefix('/data')->group(function () {
            route::get('/', [UserDataRequestController::class, 'proposal'])->name('data_request_proposal');
            route::post('/', [UserDataRequestController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserDataRequestController::class, 'check'])->name('data_request_check');
                route::get('/{license_number}', [UserDataRequestController::class, 'details'])->name('data_request_details')->middleware('authenticated_user');;
            });
        });

        Route::prefix('/loan')->group(function () {
            route::get('/', [UserLoanController::class, 'proposal'])->name('loan_proposal');
            route::post('/', [UserLoanController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserLoanController::class, 'check'])->name('loan_check');
                route::get('/{license_number}', [UserLoanController::class, 'details'])->name('loan_details')->middleware('authenticated_user');;
            });
        });

        Route::prefix('/practicum')->group(function () {
            route::get('/', [UserPracticumController::class, 'proposal'])->name('practicum_proposal');
            route::post('/', [UserPracticumController::class, 'store']);

            Route::prefix('/check')->group(function () {
                route::get('/', [UserPracticumController::class, 'check'])->name('practicum_check');
                route::get('/{license_number}', [UserPracticumController::class, 'details'])->name('practicum_details')->middleware('authenticated_user');;
            });
        });
    });
});

/**
 * Admin Routes
 */

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'show'])->name('admin_dashboard');
        Route::get('/filter', [ReportController::class, 'getFilters'])->name('getFilters');

        /**
         * Recap Route
         */
        Route::get('/export-research', [RecapController::class, 'exportResearch'])->name('exportResearch');
        Route::get('/export-data-request', [RecapController::class, 'exportDataRequest'])->name('exportDataRequest');
        Route::get('/export-loan', [RecapController::class, 'exportLoan'])->name('exportLoan');
        Route::get('/export-practicum', [RecapController::class, 'exportPracticum'])->name('exportPracticum');

        Route::get('/reports', [ReportController::class, 'show'])->name('showReports');

        /**
         * Super Admin Route
         */
        Route::middleware('superadmin')->group(function () {
            Route::get('/manage', [AdminDashboardController::class, 'showManageAdmins'])->name('manageAdmins');
            Route::post('/createAdmin', [AdminDashboardController::class, 'createAdmin'])->name('createAdmin');
            Route::delete('/deleteAdmin', [AdminDashboardController::class, 'deleteAdmin'])->name('deleteAdmin');
            Route::put('/editAdmin', [AdminDashboardController::class, 'editAdmin'])->name('editAdmin');
            Route::post('/changePassword', [AdminDashboardController::class, 'changePassword'])->name('changePassword');

            Route::get('/faculty', [FacultyController::class, 'show'])->name('manageFaculty');
            Route::post('/addFaculty', [FacultyController::class, 'addFaculty'])->name('addFaculty');
            Route::put('/editFaculty', [FacultyController::class, 'editFaculty'])->name('editFaculty');
            Route::delete('/deleteFaculty', [FacultyController::class, 'deleteFaculty'])->name('deleteFaculty');

            Route::post('/addAcademicProgram', [FacultyController::class, 'addAcademicProgram'])->name('addAcademicProgram');
            Route::put('/editAcademicProgram', [FacultyController::class, 'editAcademicProgram'])->name('editAcademicProgram');
            Route::delete('/deleteAcademicProgram', [FacultyController::class, 'deleteAcademicProgram'])->name('deleteAcademicProgram');
        });

        Route::get('/location', [LocationController::class, 'show'])->name('location');
        Route::post('/location', [LocationController::class, 'addLocation'])->name('addLocation');
        Route::delete('/location', [LocationController::class, 'deleteLocation'])->name('deleteLocation');
        Route::put('/location', [LocationController::class, 'updateLocation'])->name('updateLocation');

        Route::get('/news', [NewsController::class, 'show'])->name('news');
        Route::get('/news/{id}', [NewsController::class, 'details'])->name('details_news');
        Route::post('/news', [NewsController::class, 'store'])->name('store_news');
        Route::delete('/news', [NewsController::class, 'delete'])->name('delete_news');
        Route::put('/news', [NewsController::class, 'update'])->name('update_news');

        Route::post('/accept', [ConfirmationController::class, 'accept'])->name('accept');
        Route::post('/reject', [ConfirmationController::class, 'reject'])->name('reject');

        Route::prefix('/template')->group(function () {
            Route::get('/', [LicenseGenerator::class, 'show'])->name('template');
            Route::post('/', [LicenseGenerator::class, 'store'])->name('store_template');
            Route::post('/update', [LicenseGenerator::class, 'update'])->name('update_template');
            Route::get('/details/{id}', [LicenseGenerator::class, 'details'])->name('details_template');
            Route::get('/final-template/{id}/{user_id}/{license_number}', [LicenseGenerator::class, 'detailsTemplate']);
            Route::get('/license-formats', [LicenseGenerator::class, 'getLicenseFormat'])->name('get-license-formats');

            /**
             * Letterhead Control
             */
            Route::post('/update-kop', [LicenseGenerator::class, 'updateKop'])->name('update_kop');
            Route::post('/delete-kop', [LicenseGenerator::class, 'deleteKop'])->name('delete_kop');

            /**
             * Signature Control
             */
            Route::post('/update-signature', [LicenseGenerator::class, 'updateSignature'])->name('update_signature');
            Route::post('/delete-signature', [LicenseGenerator::class, 'deleteSignature'])->name('delete_signature');

            /**
             * Signature Control
             */
            Route::post('/update-footer-image', [LicenseGenerator::class, 'updateFooterImage'])->name('update_footer_image');
            Route::post('/delete-footer-image', [LicenseGenerator::class, 'deleteFooterImage'])->name('delete_footer_image');

            /**
             * License User Control
             */
            Route::get('/license-user', [LicenseFormatUserController::class, 'getLicenseUser'])->name('get-license-user');
            Route::post('/create-license-user', [LicenseFormatUserController::class, 'postLicenseUser'])->name('post-license-user');
            Route::post('/delete-license-user', [LicenseFormatUserController::class, 'deleteLicenseUser'])->name('delete-license-user');

            /**
             * License Service Control
             */
            Route::get('/license-service/{type}', [LicenseFormatServiceController::class, 'getLicenseService'])->name('get-license-service');
            Route::post('/create-license-service', [LicenseFormatServiceController::class, 'postLicenseService'])->name('post-license-service');
            Route::post('/delete-license-service', [LicenseFormatServiceController::class, 'deleteLicenseService'])->name('delete-license-service');

            /**
             * License Body Control
             */

            Route::post('/create-license-body', [LicenseFormatBodyController::class, 'createLicenseBody'])->name('create-license-body');
            Route::post('/update-license-body', [LicenseFormatBodyController::class, 'updateLicenseBody'])->name('update-license-body');

            Route::post('/save-template', [LicenseGenerator::class, 'saveTemplate'])->name('saveTemplate');
        });

        Route::prefix('/research')->group(function () {
            Route::prefix('/check')->group(function () {
                Route::get('/', [AdminResearchController::class, 'check'])->name('admin_research_check');
                Route::get('/{license_number}', [AdminResearchController::class, 'details'])->name('admin_research_details');
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
