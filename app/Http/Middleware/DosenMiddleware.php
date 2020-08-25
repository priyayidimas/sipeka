<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class DosenMiddleware
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
        if($user->level == 0)
            return redirect('mhs');

        if($user->dosen()->count() == 0 && $user->level == 0)
            return redirect('mhs/pelengkapan-data');

        if($user->dosen()->count() == 0)
            return redirect('dosen/pelengkapan-data');

        return $next($request);
    }
}
