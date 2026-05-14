<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\DocumentRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResidentApprovedMail;
use App\Mail\ResidentRejectedMail;
use App\Models\Announcement;

class BarangayController extends Controller
{

    public function residentVerification()
    {
        // PENDING RESIDENTS

        $residents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'pending'
            )
            ->get();

        // APPROVED RESIDENTS

        $approvedResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'active'
            )
            ->latest()
            ->get();

        // REJECTED RESIDENTS

        $rejectedResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'rejected'
            )
            ->latest()
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

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcement->delete();

        return redirect()
            ->back()
            ->with('success', 'Announcement deleted successfully.');
    }

    public function approveResident($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'active';

        $user->save();

        Mail::to($user->email)
            ->send(new ResidentApprovedMail($user));

        return redirect('/barangay/resident-verification')
            ->with('success', 'Resident approved successfully.');
    }

    public function rejectResident($id)
    {
        $user = User::findOrFail($id);

        Mail::to($user->email)
            ->send(new ResidentRejectedMail($user));

        $user->delete();

        return redirect('/barangay/resident-verification')
            ->with('success', 'Resident rejected successfully.');
    }

    public function markOngoing($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->status = 'ongoing';

        $complaint->save();

        return redirect()->back();
    }

    public function markresolve($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->status = 'resolved';

        $complaint->save();

        return redirect()->back();
    }

    public function deleteComplaint($id)
    {
        Complaint::findOrFail($id)->delete();

        return redirect('/barangay/complaints')
            ->with('success', 'Complaint deleted successfully.');
    }

    public function saveComplaintNote(
        Request $request,
        $id
    ) {

        $complaint =
            Complaint::findOrFail($id);

        $complaint->notes =
            $request->notes;

        $complaint->save();

        return back();
    }

    public function editComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);

        $categories = [

            'Noise Complaint',
            'Road Issue',
            'Sanitation',
            'Dispute',
            'Flooding',
            'Illegal Parking',
            'Street Light Issue',
            'Garbage Collection',
            'Water Problem',
            'Electricity Problem',
            'Public Disturbance',
            'Drainage Issue',
            'Animal Complaint',
            'Construction Issue',
            'Health Concern',
            'Domestic Issue',
            'Fire Hazard',
            'Vandalism',
            'Traffic Concern'

        ];

        return view(
            'barangay.edit-complaint',
            compact(
                'complaint',
                'categories'
            )
        );
    }

    public function updateComplaint(
        Request $request,
        $id
    ) {

        $complaint = Complaint::findOrFail($id);

        $complaint->update([

            'complainant_name' =>
            $request->complainant_name,

            'category' => json_encode(
                $request->category
            ),

            'description' =>
            $request->description

        ]);

        return redirect(
            '/barangay/complaints'
        );
    }

    public function viewComplaint($id)
    {
        $complaint = Complaint::find($id);

        return view(
            'barangay.view-complaint',
            compact('complaint')
        );
    }

    public function complaints(Request $request)
    {

        $query = Complaint::query();

        // CATEGORY FILTER

        if (
            $request->has('categories') &&
            !empty($request->categories)
        ) {

            $query->where(function ($q)
            use ($request) {

                foreach (
                    $request->categories
                    as $category
                ) {

                    $q->orWhere(
                        'category',
                        'LIKE',
                        '%' . $category . '%'
                    );
                }
            });
        }

        // STATUS FILTER

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }

        // DATE FILTER

        if ($request->date) {

            $query->whereDate(
                'created_at',
                $request->date
            );
        }

        $complaints = $query
            ->latest()
            ->get();

        $residents = User::where(
            'role',
            'resident'
        )
            ->where(
                'status',
                'approved'
            )
            ->get();

        $categories = [

            'Noise Complaint',
            'Road Issue',
            'Sanitation',
            'Flooding',
            'Illegal Parking',
            'Street Light Issue',
            'Garbage Collection',
            'Water Problem',
            'Electricity Problem'

        ];

        $residents = Resident::where(
            'barangay',
            auth('worker')->user()?->barangay
        )->get();

        return view(
            'barangay.complaints',
            compact(
                'complaints',
                'residents',
                'categories'
            )
        );
    }

    public function ongoingComplaint($id)
    {

        $complaint = Complaint::find($id);

        $complaint->status = 'ongoing';

        $complaint->save();

        return back();
    }

    public function resolveComplaint($id)
    {
        $complaint = Complaint::find($id);

        if ($complaint) {

            $complaint->status = 'resolved';

            $complaint->save();
        }

        return redirect('/barangay/complaints');
    }

    public function generatePDF($id)
    {

        $request = DocumentRequest::find($id);

        $pdf = Pdf::loadView(
            'barangay.request-pdf',
            compact('request')
        );

        return $pdf->download(
            'document-request.pdf'
        );
    }

    public function requests()
    {

        $requests = DocumentRequest::whereHas('user', function ($query) {

            $query->where(
                'barangay',
                Auth::guard('worker')->user()->barangay
            );
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'barangay.requests',
            compact('requests')
        );
    }

    public function approveRequest($id)
    {

        $request = DocumentRequest::find($id);

        $request->status = 'approved';

        $request->save();

        return back();
    }

    public function rejectRequest($id)
    {

        $request = DocumentRequest::find($id);

        $request->status = 'rejected';

        $request->save();

        return back();
    }

    public function dashboard()
    {

        $barangay =
            Auth::guard('worker')
            ->user()
            ->barangay;

        // TOTAL RESIDENTS

        $totalResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'barangay',
                $barangay
            )
            ->count();

        // PENDING VERIFICATION

        $pendingResidents = User::where(
            'role',
            'resident'
        )
            ->where(
                'barangay',
                $barangay
            )
            ->where(
                'status',
                'pending'
            )
            ->count();

        // COMPLAINTS

        $totalComplaints =
            Complaint::count();

        // REQUESTS

        $totalRequests =
            DocumentRequest::count();

        // ANNOUNCEMENTS

        $announcements =
            Announcement::latest()->get();

        return view(
            'barangay.dashboard',
            compact(
                'totalResidents',
                'pendingResidents',
                'totalComplaints',
                'totalRequests',
                'announcements'
            )
        );
    }

    public function residents(Request $request)
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

        $residents = $query->get();

        return view(
            'barangay.residents',
            compact('residents')
        );
    }

    public function storeResident(Request $request)
    {

        Resident::create([

            'full_name' =>
            $request->full_name,

            'age' =>
            $request->age,

            'gender' =>
            $request->gender,

            'birthdate' =>
            $request->birthdate,

            'civil_status' =>
            $request->civil_status,

            'address' =>
            $request->address,

            'barangay' =>
            auth('worker')->user()?->barangay

        ]);

        return back();
    }

    public function deleteResident($id)
    {

        Resident::find($id)->delete();

        return back();
    }
}
