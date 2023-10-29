<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class TokenSaver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->get("token");
        if(!$token)
            return $next($request);
        $request->headers->set("Authorization", "Bearer $token");
        $user = Auth::guard('api') -> user();
        if (!$user)
            return redirect('http://localhost:5500');
        Auth::login($user);
        return $next($request);
    }
}
