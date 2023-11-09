<?php

namespace App\Http\Middleware;

use App\Models\PersonaRol;
use Closure;
use Illuminate\Http\Request;

class VerificarRol
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
        if(!$request -> user())
            return redirect("http://localhost:5500");
        $rol = PersonaRol::findOrFail($request ->user()->id)->rol;
        if($rol != "administrador" && $rol != "gerente")
            return redirect("http://localhost:5500");
        return $next($request);
    }
}
