<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|max:100',
            'username'=>['required','min:5','max:100', 'unique:users'],
            'email'=> 'required|email:dns|unique:users',
            'password'=> 'required|min:5|max:100'
        ]);

        $validateData['password']=bcrypt($validateData['password']);

        User::create($validateData);

        // $request->session()->flash('success', 'Registration Successfull! Please Login Now');
        Session::flash('success','Registration Successfull! Please Login Now');

        return redirect('/login');
    }
}
