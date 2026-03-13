<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Debugging: Jika masih forbidden, tambahkan baris di bawah ini sebentar untuk cek
        // dd(Auth::user()->role, $role); 

        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Akses Ditolak! Role Anda adalah: ' . (Auth::user()->role ?? 'Tidak ada'));
        }

        return $next($request);
    }
}
