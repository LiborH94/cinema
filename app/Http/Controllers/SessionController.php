<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
                    'email' => 'Zadaný email nebo heslo jsou chybné.',
                    'password' => 'Zadaný email nebo heslo jsou chybné.',
                ])
                ->withInput();
        }
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Přihlášení proběhlo úspěšně.');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Odhlášení proběhlo úspěšně.');
    }

    public function initSeed()
    {
        if (User::exists()) {
            abort(403, 'Databáze již obsahuje data. Tuto akci nelze provést.');
        }

        Artisan::call('migrate:fresh', ['--seed' => true]);
        return redirect()->route('login')
        ->with('success', 'Databáze byla úspěšně inicializována! Nyní se můžete přihlásit jako Admin (admin@cinema.test / admin123).');
    }
}
