<?php

namespace portaria\Http\Middleware;

use Closure;

class Administrador
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
        $user = \Auth::user();
        if(!$user->master)
        {
            $data = [
            'type' => 'danger',
            'title' => 'Erro - Acesso Mestre',
            'message' => 'Usuário sem acesso ao recurso: '.$request->url(),
            ];
            return view('utils.genericError', $data);
        }

        return $next($request);
    }
}
