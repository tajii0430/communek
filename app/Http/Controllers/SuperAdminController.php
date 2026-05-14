<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangay;
use App\Models\User;

class SuperAdminController extends Controller
{

    public function workers()
    {

        $workers = User::where(
            'role',
            'barangay_worker'
        )->latest()->get();

        $barangays = Barangay::all();

        return view(
            'superadmin.workers',
            compact(
                'workers',
                'barangays'
            )
        );
    }

    public function storeWorker(Request $request)
    {

        User::create([

            'name' =>
            $request->name,

            'username' =>
            $request->username,

            'email' =>
            $request->email,

            'password' =>
            bcrypt($request->password),

            'role' =>
            'barangay_worker',

            'barangay' =>
            $request->barangay,

            'status' =>
            'active'

        ]);

        return back();
    }

    public function deleteWorker($id)
    {

        User::find($id)->delete();

        return back();
    }


    public function dashboard()
    {
        $totalResidents = \App\Models\Resident::count();

        $totalBarangays = \App\Models\Barangay::count();

        $totalWorkers = \App\Models\User::where(
            'role',
            'barangay_worker'
        )->count();

        return view(
            'superadmin.dashboard',
            compact(
                'totalResidents',
                'totalBarangays',
                'totalWorkers'
            )
        );
    }
    public function dashboardData()
    {
        return response()->json([

            'totalResidents' => \App\Models\Resident::count(),

            'totalBarangays' => \App\Models\Barangay::count(),

            'totalWorkers' => \App\Models\User::where(
                'role',
                'barangay_worker'
            )->count()

        ]);
    }

    public function barangays()
    {

        $barangays = Barangay::latest()->get();

        return view(
            'superadmin.barangays',
            compact('barangays')
        );
    }

    public function storeBarangay(Request $request)
    {

        Barangay::create([

            'barangay_name' =>
            $request->barangay_name,

            'city' =>
            $request->city,

            'province' =>
            $request->province,

            'region' =>
            $request->region

        ]);

        return back();
    }

    public function deleteBarangay($id)
    {

        Barangay::find($id)->delete();

        return back();
    }
}
