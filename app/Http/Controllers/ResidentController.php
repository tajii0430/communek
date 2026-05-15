<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Cloudinary\Cloudinary;

class ResidentController extends Controller
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

        if (!$resident) {

            return back()->with(
                'error',
                'Resident not found.'
            );
        }

        $qrCode = 'data:image/svg+xml;base64,' . base64_encode(

            QrCode::format('svg')
                ->size(200)
                ->generate(json_encode([

                    'name'           => $resident->full_name,
                    'contact_number' => $resident->contact_number,
                    'gender'         => $resident->gender,
                    'birthdate'      => $resident->birthdate,
                    'civil_status'   => $resident->civil_status,
                    'sitio'          => $resident->address,
                    'barangay'       => $resident->barangay,
                    'resident_id'    => $resident->resident_id_number,

                ]))

        );

        $pdf = Pdf::loadView('resident.id-template', [

            'resident' => $resident,
            'qrCode'   => $qrCode

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
        | COMPUTE AGE
        |--------------------------------------------------------------------------
        */

        $age = null;

        if ($request->birthdate) {

            $birthdate = Carbon::parse(
                $request->birthdate
            );

            $age = $birthdate->age;
        }

        /*
        |--------------------------------------------------------------------------
        | KEEP OLD PHOTO
        |--------------------------------------------------------------------------
        */

        $photoPath = $resident->profile_photo;

        /*
        |--------------------------------------------------------------------------
        | PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_photo')) {

            try {

                $cloudinary = new Cloudinary(
                    env('CLOUDINARY_URL')
                );

                $uploadedFile = $cloudinary
                    ->uploadApi()
                    ->upload(
                        $request->file('profile_photo')->getRealPath(),
                        [
                            'folder' => 'resident_photos'
                        ]
                    );

                /*
                |--------------------------------------------------------------------------
                | GET CLOUDINARY SECURE URL
                |--------------------------------------------------------------------------
                */

                $uploadedArray = $uploadedFile->getArrayCopy();

                if (
                    isset($uploadedArray['storage']) &&
                    isset($uploadedArray['storage']['secure_url'])
                ) {

                    $photoPath =
                        $uploadedArray['storage']['secure_url'];
                }
            } catch (\Exception $e) {

                return back()->with(
                    'error',
                    'Cloudinary Upload Failed: ' . $e->getMessage()
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
        | UPDATE PROFILE
        |--------------------------------------------------------------------------
        */

        $resident->update([

            'contact_number'     => $request->contact_number,
            'age'                => $age,
            'gender'             => $request->gender,
            'birthdate'          => $request->birthdate,
            'civil_status'       => $request->civil_status,
            'address'            => $request->address,
            'profile_photo'      => $photoPath,
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

    public function complaints()
    {
        $complaints = \App\Models\Complaint::where(
            'complainant_name',
            auth()->user()->name
        )->latest()->get();

        return view(
            'resident.complaints',
            compact('complaints')
        );
    }

    public function dashboard()
    {
        $resident = auth('resident')->user();

        /*
    |--------------------------------------------------------------------------
    | ANNOUNCEMENTS
    |--------------------------------------------------------------------------
    */

        $announcements = \App\Models\Announcement::latest()
            ->take(5)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | DOCUMENT REQUEST COUNT
    |--------------------------------------------------------------------------
    */

        $documentRequests =
            \App\Models\DocumentRequest::where(
                'user_id',
                $resident->id
            )->count();

        /*
    |--------------------------------------------------------------------------
    | ACTIVE COMPLAINTS COUNT
    |--------------------------------------------------------------------------
    */

        $activeComplaints =
            \App\Models\Complaint::where(
                'complainant_name',
                auth('resident')->user()->name
            )
            ->where('status', '!=', 'resolved')
            ->count();

        /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    */

        return view(
            'resident.dashboard',
            compact(
                'announcements',
                'documentRequests',
                'activeComplaints'
            )
        );
    }

    /*
|--------------------------------------------------------------------------
| SHOW APPROVED RESIDENTS
|--------------------------------------------------------------------------
*/

    public function index(Request $request)
    {
        $query = Resident::query();

        /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

        if ($request->search) {

            $query->where(
                'full_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | GENDER FILTER
    |--------------------------------------------------------------------------
    */

        if ($request->gender) {

            $query->where(
                'gender',
                $request->gender
            );
        }

        /*
    |--------------------------------------------------------------------------
    | AGE FILTER
    |--------------------------------------------------------------------------
    */

        if ($request->age) {

            $query->where(
                'age',
                $request->age
            );
        }

        /*
    |--------------------------------------------------------------------------
    | SITIO FILTER
    |--------------------------------------------------------------------------
    */

        if ($request->sitio) {

            $query->where(
                'address',
                'like',
                '%' . $request->sitio . '%'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | GET RESIDENTS
    |--------------------------------------------------------------------------
    */

        $residents = $query
            ->latest()
            ->get();

        /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    */

        return view(
            'barangay.residents',
            compact('residents')
        );
    }
}
