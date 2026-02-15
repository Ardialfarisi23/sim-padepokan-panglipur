<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {


            $user = Auth::user();


            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }


            if ($user->role === 'anggota') {
                return redirect('/anggota/dashboard');
            }


            // fallback jika role tidak dikenali
            Auth::logout();
            return redirect('/login');
        }


        return $next($request);
    }
}
