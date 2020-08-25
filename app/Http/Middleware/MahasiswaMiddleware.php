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

        if($user->level == 1)
            return redirect('dosen');

        if($user->mahasiswa()->count() == 0 && $user->level == 1)
            return redirect('dosen/pelengkapan-data');

        if($user->mahasiswa()->count() == 0)
            return redirect('mhs/pelengkapan-data');

        return $next($request);
    }
}
