<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('is_admin')) {
            return redirect()->route('admin.leads');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $emailOk = hash_equals(
            strtolower((string) env('ADMIN_EMAIL', 'admin@example.com')),
            strtolower((string) $request->input('email'))
        );
        $passOk = hash_equals((string) env('ADMIN_PASSWORD', 'admin'), (string) $request->input('password'));

        if ($emailOk && $passOk) {
            $request->session()->regenerate();
            $request->session()->put('is_admin', true);

            return redirect()->route('admin.leads');
        }

        return back()->withErrors(['email' => 'Incorrect email or password.'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
