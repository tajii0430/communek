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
        // HARD CODED SUPER ADMIN

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

        if (Auth::guard('worker')->attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::guard('worker')->user();

            if ($user->role == 'super_admin') {
                return redirect('/superadmin/dashboard');
            }

            if ($user->role == 'barangay_worker') {
                return redirect('/barangay/dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid username or password'
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
