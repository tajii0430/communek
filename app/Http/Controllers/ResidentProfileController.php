<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'contact_number' => 'nullable|string|max:20',
            'gender'         => 'nullable|string|max:20',
            'birthdate'      => 'nullable|date',
            'civil_status'   => 'nullable|string|max:50',
            'address'        => 'nullable|string|max:255',
            'profile_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:4096',

        ]);

        /*
        |--------------------------------------------------------------------------
        | AUTO COMPUTE AGE
        |--------------------------------------------------------------------------
        */

        $age = null;

        if ($request->birthdate) {

            $birthdate = Carbon::parse(
                $request->birthdate
            );

            $currentDate = Carbon::now();

            $age = $birthdate->diffInYears(
                $currentDate
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PROFILE PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        $photoPath = $resident->profile_photo;

        if ($request->hasFile('profile_photo')) {

            try {

                $cloudinary = new Cloudinary([

                    'cloud' => [

                        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                        'api_key'    => env('CLOUDINARY_API_KEY'),
                        'api_secret' => env('CLOUDINARY_API_SECRET'),

                    ],

                ]);

                $uploadResult = $cloudinary
                    ->uploadApi()
                    ->upload(

                        $request->file('profile_photo')->getRealPath(),

                        [
                            'folder' => 'resident_photos'
                        ]

                    );

                $photoPath = $uploadResult['secure_url']
                    ?? $uploadResult['url']
                    ?? null;
            } catch (\Exception $e) {

                return back()->with(
                    'error',
                    'Image upload failed: ' . $e->getMessage()
                );
            }
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

            'contact_number'    => $request->contact_number,
            'age'               => $age,
            'gender'            => $request->gender,
            'birthdate'         => $request->birthdate,
            'civil_status'      => $request->civil_status,
            'address'           => $request->address,
            'profile_photo'     => $photoPath,
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
