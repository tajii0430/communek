<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Barangay;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {

        $barangays = Barangay::all();

        return view(
            'auth.register',
            compact('barangays')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER RESIDENT
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {

        $request->validate([

            'name'      => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
            'barangay'  => 'required',

        ]);

        User::create([

            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'resident',
            'status'    => 'pending',
            'barangay'  => $request->barangay,

        ]);

        Auth::logout();

        return redirect('/login')
            ->with(
                'success',
                'Registration submitted successfully. Please wait for approval.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | HARDCODED SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if (
            $request->username === 'superadmin' &&
            $request->password === 'admin123'
        ) {

            session()->put('super_admin', true);

            session()->put('admin_name', 'Super Admin');

            return redirect('/superadmin/dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'username',
            $request->username
        )->first();

        /*
        |--------------------------------------------------------------------------
        | USER NOT FOUND
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return back()->with(
                'error',
                'Invalid login credentials.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ACCOUNT STATUS
        |--------------------------------------------------------------------------
        */

        if ($user->status == 'pending') {

            return back()->with(
                'error',
                'Your account is still waiting for approval.'
            );
        }

        if ($user->status == 'rejected') {

            return back()->with(
                'error',
                'Your registration was rejected.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | WORKER LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            $user->role == 'super_admin' ||
            $user->role == 'barangay_worker'
        ) {

            $credentials = [

                'username' => $request->username,
                'password' => $request->password,
                'status'   => 'active'

            ];

            if (Auth::guard('worker')->attempt($credentials)) {

                $request->session()->regenerate();

                $worker = Auth::guard('worker')->user();

                // SUPER ADMIN

                if ($worker->role == 'super_admin') {

                    return redirect('/superadmin/dashboard');
                }

                // BARANGAY WORKER

                if ($worker->role == 'barangay_worker') {

                    return redirect('/barangay/dashboard');
                }
            }

            return back()->with(
                'error',
                'Invalid admin credentials.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | RESIDENT LOGIN
        |--------------------------------------------------------------------------
        */

        $credentials = [

            'username' => $request->username,
            'password' => $request->password,
            'status'   => 'active'

        ];

        if (Auth::guard('resident')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/resident/dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | FAILED LOGIN
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'error',
            'Invalid login credentials.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {

        // REMOVE SUPER ADMIN SESSION

        session()->forget('super_admin');

        session()->forget('admin_name');

        // LOGOUT ALL GUARDS

        Auth::guard('worker')->logout();

        Auth::guard('resident')->logout();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
