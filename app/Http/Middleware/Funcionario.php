<?php

namespace portaria\Http\Middleware;

use Closure;

class Funcionario
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
            if($tipoUsuario != 'F')
            {
                $data = [
                'type' => 'danger',
                'title' => 'Erro - Acesso Funcionário',
                'message' => 'Usuário sem acesso ao recurso: '.$request->url(),
                'detail' => 'Tipo usuário: '.$tipoUsuario.' Nível de acesso: Funcionário'

                ];
                return view('utils.genericError', $data);
            }
        }
        
        return $next($request);
    }
}
