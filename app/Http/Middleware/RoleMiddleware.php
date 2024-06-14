<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = Session::get('userRole');

        // Jika pengguna bukan admin dan mencoba mengakses bagian admin
        if ($role === 'admin' && $userRole !== 'admin') {
            return redirect('/admin/dashboard'); // Atau arahkan ke halaman lain jika diperlukan
        }

        // Jika pengguna bukan user dan mencoba mengakses bagian user
        if ($role === 'user' && $userRole !== 'user') {
            return redirect('/user/dashboard'); // Atau arahkan ke halaman lain jika diperlukan
        }

        return $next($request);
    }
}
