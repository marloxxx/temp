<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->level, ['Admin', 'Supervisor'])) {
            return $next($request);
        } else if (auth()->check() && auth()->user()->level == 'Petugas') {
            return $next($request);
        }


        return redirect('/tidak-memiki-izin')->with('error', 'Tidak ada akses'); // Redirect dan tampilkan pesan akses ditolak jika bukan admin.
    }
}
