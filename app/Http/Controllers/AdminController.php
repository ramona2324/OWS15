<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    public function showSignup1() {
        return view('admin.signup-step1');
    }
}
