<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login view
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(
            'username',
            'password'
        );

        // FIND USER
        $user = \App\Models\User::where(
            'username',
            $credentials['username']
        )->first();

        // CHECK IF USER EXISTS
        if (!$user) {

            return back()->withErrors([
                'username' => 'Invalid credentials.',
            ]);
        }

        // WORKER LOGIN
        if (
            $user->role === 'barangay' ||
            $user->role === 'worker' ||
            $user->role === 'admin'
        ) {

            if (
                Auth::guard('worker')->attempt($credentials)
            ) {

                $request->session()->regenerate();

                return redirect('/barangay/dashboard');
            }
        }

        // RESIDENT LOGIN
        else {

            if (
                Auth::guard('resident')->attempt($credentials)
            ) {

                $request->session()->regenerate();

                return redirect('/resident/dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        // LOGOUT BOTH GUARDS
        Auth::guard('resident')->logout();

        Auth::guard('worker')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
