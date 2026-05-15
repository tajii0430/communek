<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentProfileController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminAuthController;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [AuthController::class, 'showRegister']
);

Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register.submit');

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    // HARDCODED SUPER ADMIN

    if (session('super_admin')) {
        return redirect('/superadmin/dashboard');
    }

    // WORKER

    if (Auth::guard('worker')->check()) {

        $user = Auth::guard('worker')->user();

        if ($user->role == 'super_admin') {
            return redirect('/superadmin/dashboard');
        }

        if ($user->role == 'barangay_worker') {
            return redirect('/barangay/dashboard');
        }
    }

    // RESIDENT

    if (Auth::guard('resident')->check()) {
        return redirect('/resident/dashboard');
    }

    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::group([], function () {

    Route::get(
        '/superadmin/dashboard',
        function () {

            // HARDCODED SUPER ADMIN

            if (session()->has('super_admin')) {

                return app(
                    \App\Http\Controllers\SuperAdminController::class
                )->dashboard();
            }

            // DATABASE SUPER ADMIN

            if (Auth::guard('worker')->check()) {

                $user = Auth::guard('worker')->user();

                if ($user->role == 'super_admin') {

                    return app(
                        \App\Http\Controllers\SuperAdminController::class
                    )->dashboard();
                }
            }

            return redirect('/login');
        }
    );

    Route::get(
        '/superadmin/barangays',
        [SuperAdminController::class, 'barangays']
    );

    Route::post(
        '/superadmin/barangays/store',
        [SuperAdminController::class, 'storeBarangay']
    );

    Route::get(
        '/superadmin/barangays/delete/{id}',
        [SuperAdminController::class, 'deleteBarangay']
    );

    Route::get(
        '/superadmin/workers',
        [SuperAdminController::class, 'workers']
    );

    Route::post(
        '/superadmin/workers/store',
        [SuperAdminController::class, 'storeWorker']
    );

    Route::get(
        '/superadmin/workers/delete/{id}',
        [SuperAdminController::class, 'deleteWorker']
    );
});

/*
|--------------------------------------------------------------------------
| ANNOUNCEMENTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:worker'])->group(function () {

    Route::get(
        '/barangay/announcements',
        [AnnouncementController::class, 'index']
    );

    Route::post(
        '/barangay/announcements',
        [AnnouncementController::class, 'store']
    );

    Route::delete(
        '/barangay/announcements/delete/{id}',
        [BarangayController::class, 'deleteAnnouncement']
    );
});

/*
|--------------------------------------------------------------------------
| BARANGAY WORKER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:worker'])->group(function () {

    Route::get('/barangay/resident/{id}', function ($id) {

        $resident = DB::table('residents')
            ->where('id', $id)
            ->first();

        return view(
            'barangay.view-resident',
            compact('resident')
        );
    });

    Route::get(
        '/barangay/dashboard',
        [BarangayController::class, 'dashboard']
    );

    Route::get(
        '/barangay/residents',
        [ResidentController::class, 'index']
    );

    Route::get(
        '/barangay/resident-verification',
        [BarangayController::class, 'residentVerification']
    );

    Route::get(
        '/barangay/resident/approve/{id}',
        [ResidentController::class, 'approve']
    );

    Route::get(
        '/barangay/resident/reject/{id}',
        [ResidentController::class, 'reject']
    );

    /*
    |--------------------------------------------------------------------------
    | COMPLAINTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/barangay/complaints',
        [BarangayController::class, 'complaints']
    );

    Route::post(
        '/barangay/complaints/store',
        [BarangayController::class, 'storeComplaint']
    );

    Route::get(
        '/barangay/complaints/view/{id}',
        [BarangayController::class, 'viewComplaint']
    );

    Route::get(
        '/barangay/complaints/edit/{id}',
        [BarangayController::class, 'editComplaint']
    );

    Route::post(
        '/barangay/complaints/update/{id}',
        [BarangayController::class, 'updateComplaint']
    );

    Route::get(
        '/barangay/complaints/ongoing/{id}',
        [BarangayController::class, 'ongoingComplaint']
    );

    Route::get(
        '/barangay/complaints/resolve/{id}',
        [BarangayController::class, 'resolveComplaint']
    );

    Route::post(
        '/barangay/complaints/note/{id}',
        [BarangayController::class, 'saveComplaintNote']
    );

    Route::delete(
        '/barangay/complaints/delete/{id}',
        [BarangayController::class, 'deleteComplaint']
    );

    /*
    |--------------------------------------------------------------------------
    | REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/barangay/requests',
        [BarangayController::class, 'requests']
    );

    Route::get(
        '/barangay/requests/approve/{id}',
        [BarangayController::class, 'approveRequest']
    );

    Route::get(
        '/barangay/requests/reject/{id}',
        [BarangayController::class, 'rejectRequest']
    );

    Route::get(
        '/barangay/requests/pdf/{id}',
        [BarangayController::class, 'generatePDF']
    );
});

/*
|--------------------------------------------------------------------------
| RESIDENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:resident'])->group(function () {

    Route::get(
        '/resident/dashboard',
        [ResidentController::class, 'dashboard']
    );

    Route::get(
        '/resident/complaints',
        [ResidentController::class, 'complaints']
    );

    Route::post(
        '/resident/complaints/store',
        [ResidentController::class, 'storeComplaint']
    )->name('resident.complaints.store');

    Route::get(
        '/resident/complaints/{id}',
        [ResidentController::class, 'viewComplaint']
    );

    Route::get(
        '/resident/complaints/view/{id}',
        [ResidentController::class, 'viewComplaint']
    );

    Route::get(
        '/resident/complaints/edit/{id}',
        [ResidentController::class, 'editComplaint']
    );

    Route::put(
        '/resident/complaints/update/{id}',
        [ResidentController::class, 'updateComplaint']
    );

    Route::get(
        '/resident/id/download',
        [ResidentProfileController::class, 'downloadResidentID']
    );

    Route::get(
        '/resident/verify/{id}',
        function ($id) {

            $resident = DB::table('residents')
                ->where('id', $id)
                ->first();

            return view(
                'resident.verify',
                compact('resident')
            );
        }
    );

    Route::get('/test-id', function () {

        $resident = DB::table('residents')->first();

        $qrCode = 'data:image/svg+xml;base64,' . base64_encode(
            QrCode::format('svg')
                ->size(200)
                ->generate('TEST QR')
        );

        return view('resident.id-template', [
            'resident' => $resident,
            'qrCode' => $qrCode
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | DOCUMENT REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/resident/documents',
        [RequestController::class, 'requests']
    );

    Route::post(
        '/resident/requests/store',
        [RequestController::class, 'store']
    );

    Route::get(
        '/resident/requests/view/{id}',
        [RequestController::class, 'show']
    );
});

/*
|--------------------------------------------------------------------------
| RESIDENT PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:resident'])->group(function () {

    Route::get('/profile', function () {

        $resident = DB::table('residents')
            ->where(
                'full_name',
                Auth::guard('resident')->user()->name
            )
            ->first();

        return view(
            'resident.profile',
            compact('resident')
        );
    });

    Route::get('/resident/profile/edit', function () {

        $resident = DB::table('residents')
            ->where(
                'full_name',
                Auth::guard('resident')->user()->name
            )
            ->first();

        return view(
            'resident.edit-profile',
            compact('resident')
        );
    });

    Route::post(
        '/resident/profile/update',
        [ResidentProfileController::class, 'update']
    );
});

require __DIR__ . '/auth.php';
