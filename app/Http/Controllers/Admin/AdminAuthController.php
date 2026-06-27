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
        $request->validate(['password' => 'required|string']);

        if (hash_equals((string) env('ADMIN_PASSWORD', 'admin'), (string) $request->input('password'))) {
            $request->session()->regenerate();
            $request->session()->put('is_admin', true);

            return redirect()->route('admin.leads');
        }

        return back()->withErrors(['password' => 'Incorrect password.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
