<?php

namespace portaria\Http\Middleware;

use Closure;

class Morador
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
            if($tipoUsuario != 'M')
            {
                $data = [
                'type' => 'danger',
                'title' => 'Erro - Acesso Morador',
                'message' => 'Usuário sem acesso ao recurso: '.$request->url(),
                'detail' => $tipoUsuario
                ];
                return view('utils.genericError', $data);
            }
        }
        
        return $next($request);
    }
}
