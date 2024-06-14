<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('dashboardAdmin');
        } else {
            return redirect()->route('dashboardUser');
        }
    }
}
