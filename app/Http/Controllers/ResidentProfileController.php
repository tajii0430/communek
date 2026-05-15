<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Cloudinary\Cloudinary;

class ResidentProfileController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD RESIDENT ID
    |--------------------------------------------------------------------------
    */

    public function downloadResidentID()
    {
        $resident = Resident::where(
            'full_name',
            Auth::guard('resident')->user()->name
        )->first();

        $qrCode = 'data:image/svg+xml;base64,' . base64_encode(
            QrCode::format('svg')
                ->size(200)
                ->generate(json_encode([

                    'name' => $resident->full_name,
                    'contact_number' => $resident->contact_number,
                    'gender' => $resident->gender,
                    'birthdate' => $resident->birthdate,
                    'civil_status' => $resident->civil_status,
                    'sitio' => $resident->address,
                    'barangay' => $resident->barangay,
                    'resident_id' => $resident->resident_id_number,

                ]))
        );

        $pdf = Pdf::loadView('resident.id-template', [

            'resident' => $resident,
            'qrCode' => $qrCode

        ])->setPaper('A4', 'landscape');

        return $pdf->download('resident-id.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {

        $resident = Resident::where(
            'full_name',
            Auth::guard('resident')->user()->name
        )->first();

        if (!$resident) {

            return back()->with(
                'error',
                'Resident profile not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AUTO COMPUTE AGE
        |--------------------------------------------------------------------------
        */

        $birthdate = Carbon::parse(
            $request->birthdate
        );

        $currentDate = Carbon::now();

        $age = $birthdate->diffInYears(
            $currentDate
        );

        /*
        |--------------------------------------------------------------------------
        | PROFILE PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        $photoPath = $resident->profile_photo;

        if ($request->hasFile('profile_photo')) {

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('profile_photo')->getRealPath(),
                [
                    'folder' => 'resident_photos'
                ]
            );

            $photoPath = $uploadedFile['secure_url'];
        }

        /*
        |--------------------------------------------------------------------------
        | GENERATE RESIDENT ID
        |--------------------------------------------------------------------------
        */

        $residentID = 'BE-' .
            date('Y') .
            '-' .
            str_pad(
                $resident->id,
                5,
                '0',
                STR_PAD_LEFT
            );

        /*
        |--------------------------------------------------------------------------
        | UPDATE RESIDENT PROFILE
        |--------------------------------------------------------------------------
        */

        $resident->update([

            'contact_number' => $request->contact_number,

            'age' => $age,

            'gender' => $request->gender,

            'birthdate' => $request->birthdate,

            'civil_status' => $request->civil_status,

            'address' => $request->address,

            'profile_photo' => $photoPath,

            'resident_id_number' => $residentID,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect('/profile')
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}
