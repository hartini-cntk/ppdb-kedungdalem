<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }
    public function register(Request $request)
    {
    $request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required|min:8',
     ]);

    $user = \App\Models\User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    ]);
    return redirect('/login');
    }
}
