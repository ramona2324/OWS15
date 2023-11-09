<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function showTest() {
        return view('test');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

}
