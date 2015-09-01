<?php

namespace portaria\Http\Middleware;

use Closure;

class Sindico
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
            $tipoUsuario =  $user->tipoUsuario;
            if($tipoUsuario != 'F' || ($tipoUsuario == 'F' && !$user->funcionario->sindico))
            {
                $data = [
                'type' => 'danger',
                'title' => 'Erro - Acesso Síndico',
                'message' => 'Usuário sem acesso ao recurso: '.$request->url(),
                'detail' => var_dump($user)
                ];
                return view('utils.genericError', $data);
            }
        }

        return $next($request);
    }
}
