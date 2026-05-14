<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Resident;
use Illuminate\Support\Facades\Mail;
use App\Models\Announcement;

class ResidentController extends Controller
{


    public function residentVerification()
    {
        // PENDING

        $residents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'pending'
            )
            ->get();

        // APPROVED

        $approvedResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'active'
            )
            ->get();

        // REJECTED

        $rejectedResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'rejected'
            )
            ->get();

        return view(
            'barangay.resident-verification',
            compact(
                'residents',
                'approvedResidents',
                'rejectedResidents'
            )
        );
    }

    public function updateComplaint(
        Request $request,
        $id
    ) {
        $complaint =
            Complaint::findOrFail($id);

        $complaint->update([

            'description' =>
            $request->description

        ]);

        return back()
            ->with(
                'success',
                'Complaint updated!'
            );
    }

    public function viewComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view(
            'resident.view-complaint',
            compact('complaint')
        );
    }

    public function editComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view(
            'resident.edit-complaint',
            compact('complaint')
        );
    }

    public function storeComplaint(Request $request)
    {
        $request->validate([

            'category' => 'required',

            'description' => 'required',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName =
                time() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads'),
                $imageName
            );

            $imagePath = 'uploads/' . $imageName;
        }

        Complaint::create([

            'complainant_name' =>
            auth()->user()->name,

            'category' =>
            json_encode($request->category),

            'description' =>
            $request->description,

            'barangay' =>
            auth()->user()->barangay,

            'image' =>
            $imagePath,

            'status' =>
            'pending',

            'latitude' =>
            $request->latitude,

            'longitude' =>
            $request->longitude,

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Complaint submitted successfully!'
            );
    }
    public function complaints()
    {
        $complaints = Complaint::where(
            'complainant_name',
            auth()->user()->name
        )->latest()->get();

        return view(
            'resident.complaints',
            compact('complaints')
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

        // SEARCH
        if ($request->search) {
            $query->where(
                'full_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // GENDER FILTER
        if ($request->gender) {
            $query->where(
                'gender',
                $request->gender
            );
        }

        // AGE FILTER
        if ($request->age) {
            $query->where(
                'age',
                $request->age
            );
        }

        // SITIO FILTER
        if ($request->sitio) {
            $query->where(
                'address',
                'like',
                '%' . $request->sitio . '%'
            );
        }

        $residents = $query->latest()->get();

        return view(
            'barangay.residents',
            compact('residents')
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SHOW PENDING RESIDENTS
    |--------------------------------------------------------------------------
    */

    public function verification()
    {

        $residents = User::where('role', 'resident')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view(
            'barangay.resident-verification',
            compact('residents')
        );
    }

    /*
|--------------------------------------------------------------------------
| APPROVE RESIDENT
|--------------------------------------------------------------------------
*/
    public function approve($id)
    {
        // GET USER
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // UPDATE STATUS IN USERS TABLE
        $user->status = 'active';
        $user->save();

        // SEND EMAIL
        Mail::raw(
            "CommuNek\n\nGood day " . $user->name . "!\n\nYour barangay registration has been APPROVED.\nYou may now log in to the Resident Portal.\n\nThank you for registering with us!",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Barangay Registration Approved');
            }
        );

        // CHECK IF ALREADY EXISTS IN RESIDENTS TABLE
        $existingResident = Resident::where('full_name', $user->name)->first();

        if (!$existingResident) {

            Resident::create([
                'full_name'      => $user->name,
                'contact_number' => $user->contact_number ?? '',
                'age'            => $user->age ?? 0,
                'gender'         => $user->gender ?? '',
                'birthdate'      => $user->birthdate ?? now(),
                'civil_status'   => $user->civil_status ?? '',
                'address'        => $user->address ?? '',
                'barangay'       => $user->barangay ?? '',
            ]);
        }

        return redirect('/barangay/resident-verification')
            ->with('success', 'Resident approved successfully.');
    }

    /*
|--------------------------------------------------------------------------
| REJECT RESIDENT
|--------------------------------------------------------------------------
*/

    public function reject($id)
    {
        /*
    |--------------------------------------------------------------------------
    | FIND USER
    |--------------------------------------------------------------------------
    */

        $user = User::find($id);
        Mail::raw(
            "!\nCommuNek\n\nGood day " . $user->name . "\nWe regret to inform you that your barangay registration was REJECTED.\nPlease contact your barangay office for more information.\n\nThank you for your understanding.",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Barangay Registration Rejected');
            }
        );

        if (!$user) {

            return redirect()->back()
                ->with(
                    'error',
                    'Resident not found.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

        $user->status = 'rejected';

        $user->save();

        return redirect('/barangay/resident-verification')
            ->with(
                'success',
                'Resident rejected successfully.'
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
}
