<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Verifica se o usuário está logado e é admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        // Se não estiver logado ou não for admin, retorna 403
        if (! Auth::check() || ! Auth::user()->is_admin) {
            abort(403, 'Acesso negado.');
        }

        // Caso contrário, segue adiante
        return $next($request);
    }
}
