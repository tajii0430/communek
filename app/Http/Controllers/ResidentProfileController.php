<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ResidentProfileController extends Controller
{


    public function downloadResidentID()
    {
        $resident = Resident::where(
            'full_name',
            Auth::user()->name
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

    public function update(Request $request)
    {

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
        | UPDATE RESIDENT PROFILE
        |--------------------------------------------------------------------------
        */

        $photoPath = null;

        if ($request->hasFile('profile_photo')) {

            $photoPath = $request
                ->file('profile_photo')
                ->store(
                    'resident_photos',
                    'public'
                );
        }

        $residentID = 'BE-' .
            date('Y') .
            '-' .
            str_pad(
                Auth::id(),
                5,
                '0',
                STR_PAD_LEFT
            );

        DB::table('residents')
            ->where('full_name', Auth::user()->name)
            ->update([

                'contact_number' =>
                $request->contact_number,

                'age' =>
                $age,

                'gender' =>
                $request->gender,

                'birthdate' =>
                $request->birthdate,

                'civil_status' => $request->civil_status,

                'address' =>
                $request->address,

                'profile_photo' =>
                $photoPath,

                'resident_id_number' =>
                $residentID,

            ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT BACK TO PROFILE
        |--------------------------------------------------------------------------
        */

        return redirect('/profile')
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}
