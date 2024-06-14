<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin.dashboardAdmin',[
        ]);
    }
    
    public function user()
    {
        return view('user.dashboard',[
        ]);
    }
}
