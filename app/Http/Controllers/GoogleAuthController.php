<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function showTest() {
        return view('test');
    }

    public function redirect() // first route the sso go through
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback() 
    {
        try {
            // $randomPassword = Str::random(10);
            $google_user_id = Socialite::driver('google')->user();
            // dd($user);
            // $finduser = User::where('google_id', $user->id)->first();
            $findStudent = Student::where('google_id', $google_user_id->getId())->first();
            if ($findStudent) {
                // dd($google_user_id);
                Auth::login($findStudent);
                return redirect('/student')->with('message', 'Successfully Logged In!');
            } else {
                // dd($google_user_id);
                try {
                    $newStudent = Student::create([
                        'student_lname' => $google_user_id->user['family_name'],
                        'student_fname' => $google_user_id->user['given_name'],
                        'student_picture' => $google_user_id->user['picture'],
                        'email' => $google_user_id->user['email'],
                        // 'admin_email' => $google_user_id->user['email'],
                        'google_id' => $google_user_id->user['id'],
                        // 'password' => '' // you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
                    ]);
                } catch (Exception $e) {
                    // Log or print the exception message for debugging
                    dd($e->getMessage());
                }
                // dd($newStudent);
                Auth::login($newStudent);  //this is for logging the student in
                
                // Store 'google_id' in the session
                session()->put('google_id', $google_user_id->user['id']);

                return redirect(route('signup1'));

                // return redirect('/student')->with('message', 'Successfully created your student account!');
            }
        } catch (Exception $e) {
            back();
        }
    }

}
