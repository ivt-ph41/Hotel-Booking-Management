<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Entities\Role;
class IsAdmin
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
        if (Auth::check())
        {
            $user_role = Auth::user()->role_id;


            if ($user_role == Role::ADMIN_ROLE)
            {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
