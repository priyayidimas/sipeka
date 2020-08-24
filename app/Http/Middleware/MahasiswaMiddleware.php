<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class MahasiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::id());
        if(session('akses') == 'dosen')
            return redirect('dosen');
        if($user->mahasiswa()->count() == 0)
            return redirect('mhs/pelengkapan-data');
        if($user->dosen()->count() > 0)
            return redirect('dosen');

        return $next($request);
    }
}
