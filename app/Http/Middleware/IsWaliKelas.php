<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Teacher;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsWaliKelas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'ADMIN') {
                abort(403);
            }
            $guru = Teacher::where('npk', auth()->user()->username)->first();
            $cek = WaliKelas::where('unique_teacher', $guru->unique)->first();
            if (!auth()->check() || !$cek) {
                abort(403);
            } else {
                return $next($request);
            }
        }
    }
}
