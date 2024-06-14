<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class loginController extends Controller
{
    //
    public function index()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $firebaseAuth = Firebase::auth();
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);

            $user = $signInResult->data();

            return view('home', ['user' => $user]);
        } catch (\Exception $e) {
            session()->flash('error', 'Login failed. Please try again');
        }
    }
}
