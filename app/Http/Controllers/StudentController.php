<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showIndex() {
        return view('student.index');
    }

    public function showLogin() {
        return view('student.login');
    }

    public function showSignup1() {
        return view('student.signup-step1');
    }
}
