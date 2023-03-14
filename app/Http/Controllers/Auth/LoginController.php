<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() :View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with(
            'error', 'Provided credentials do not match',
        )->onlyInput('email');
    }
}
