<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
            'status'    => 'active',
            'barangay'  => $request->barangay,

        ]);

        return redirect('/login')
            ->with(
                'success',
                'Account created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        // =========================================
        // HARDCODED SUPER ADMIN
        // =========================================

        if (
            $request->username === 'superadmin' &&
            $request->password === 'admin123'
        ) {

            session([
                'super_admin' => true,
                'admin_name' => 'Super Admin'
            ]);

            return redirect('/superadmin/dashboard');
        }

        // =========================================
        // WORKER LOGIN
        // =========================================

        $workerCredentials = [

            'username' => $request->username,
            'password' => $request->password

        ];

        if (
            Auth::guard('worker')->attempt(
                $workerCredentials
            )
        ) {

            $request->session()->regenerate();

            $user = Auth::guard('worker')->user();

            // SUPER ADMIN

            if ($user->role == 'super_admin') {

                return redirect('/superadmin/dashboard');
            }

            // BARANGAY WORKER

            if ($user->role == 'barangay_worker') {

                return redirect('/barangay/dashboard');
            }
        }

        // =========================================
        // RESIDENT LOGIN
        // =========================================

        $residentCredentials = [

            'username' => $request->username,
            'password' => $request->password

        ];

        if (
            Auth::guard('resident')->attempt(
                $residentCredentials
            )
        ) {

            $request->session()->regenerate();

            return redirect('/resident/dashboard');
        }

        // =========================================
        // FAILED LOGIN
        // =========================================

        return back()->withErrors([

            'username' => 'Invalid username or password.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        // SUPER ADMIN SESSION

        session()->forget('super_admin');

        // WORKER

        Auth::guard('worker')->logout();

        // RESIDENT

        Auth::guard('resident')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
