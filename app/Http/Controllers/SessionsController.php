<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $creds = $request->validate([
            'email' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],

        ]);

        if (! Auth::attempt($creds)) {
            return redirect()->back()->withErrors([
                'password' => 'we were unable to aunthenticate using the provided credentials',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'You are logged in!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You are logged out!');
    }
}
