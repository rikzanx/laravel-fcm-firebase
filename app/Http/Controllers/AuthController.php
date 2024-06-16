<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    
    public function showLoginForm()
    {
        Log::info('showLoginForm method called');
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        Log::info('showRegisterForm method called');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone'=> 'required|string|max:12',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);

            return redirect('/login')->with('success', 'User registered successfully. Please login.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // dd($credentials);
                // Redirect sesuai dengan peran pengguna
                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect()->route('dashboardAdmin')->with('success', 'Login berhasil sebagai admin');
                } else {
                    return redirect()->route('dashboardUser')->with('success', 'Login berhasil sebagai user');
                }
            }
            return back()->withErrors(['error' => 'Kredensial login tidak valid. Silakan coba lagi.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function redirectToDashboard()
    {
        $user=  Auth::user();
        if($user){
            if ($user->role === 'admin') {
                return redirect()->route('dashboardAdmin');
            } else {
                return redirect()->route('dashboardUser');
            }
        }else{

            return redirect()->route('login')->with('danger', 'Success Logout');
        }
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('danger', 'Success Logout');
  
    }


}
