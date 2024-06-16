<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }
    public function admin()
    {
        $user = Auth::user();
        $notifications = Notification::with('sender')->where('user_id_to',$user->id)->get();
        if($user->role == "admin"){
            return view('admin.dashboardAdmin',[
                'notifications' => $notifications
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
