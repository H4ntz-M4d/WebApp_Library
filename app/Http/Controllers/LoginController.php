<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login.sign');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
