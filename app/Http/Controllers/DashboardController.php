<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }
    public function admin()
    {
        $user = Auth::user();
        if($user->role == "admin"){
            return view('admin.dashboardAdmin',[
            ]);
        }else{
            return redirect()->route('dashboardUser');
        }
    }
    
    public function user()
    {
        $user = Auth::user();
        $notifications = Notification::with('sender')->where('user_id_to',$user->id)->get();
        return view('user.dashboard',[
            'notifications' => $notifications
        ]);
    }
}
