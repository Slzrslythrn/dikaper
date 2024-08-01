<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleHasValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($request->user()->level == $role)
                return $next($request);
        }

        abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
