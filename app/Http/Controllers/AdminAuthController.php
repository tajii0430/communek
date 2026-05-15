<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // LOGIN PAGE

    public function loginPage()
    {
        return view('admin.login');
    }

    // LOGIN

    public function login(Request $request)
    {
        // HARDCODED SUPER ADMIN LOGIN

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

        // DATABASE LOGIN

        $credentials = [

            'username' => $request->username,
            'password' => $request->password

        ];

        // LOGIN USING WORKER GUARD

        if (Auth::guard('worker')->attempt($credentials)) {

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

        return back()->withErrors([

            'username' => 'Invalid admin credentials'

        ]);
    }

    // LOGOUT

    public function logout(Request $request)
    {
        Auth::guard('worker')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
