<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function view()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $name = $request->input('name');
        $lastName = $request->input('lastName');
        $email = $request->input('email');

        session(['loggedIn' => true]);
        session(['name' => $name]);
        session(['lastName' => $lastName]);
        session(['email' => $email]);


        return view('user', ['name' => $name, 'lastName' => $lastName, 'email' => $email]);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
