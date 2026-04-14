<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!Auth::attempt($attributes)) {
            return back()
                ->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                    'password' => 'The provided credentials do not match our records.',
                ])
                ->withInput();
        }
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
