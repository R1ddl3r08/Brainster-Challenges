<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function aboutMe()
    {
        return view('aboutMe');
    }

    public function post()
    {
        return view('post');
    }

    public function contact()
    {
        return view('contact');
    }
}
