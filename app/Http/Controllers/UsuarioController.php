<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;
use portaria\Http\Controllers\Auth\AuthController;

class UsuarioController extends Controller
{
    protected function createUser($type, $id)
    {
        $message_type = 'danger';
        $message = '<strong>Erro!</strong><br><p>Não foi possível gerar o usuário! Registro não localizado!</p>';
        
        if(strtoupper($type) == 'F')
            $row = \portaria\Funcionario::find($id);
        else
            $row = \portaria\Morador::find($id);

        if(!empty($row) &&  $row->count())
        {
            $user = \portaria\User::where('email', $row->email)->first();
            if(!empty($user) && empty($row->user_id))
            {
                //usuário existe, porém o ID não está associado ao registro de morador/funcionário
                $row->update(['user_id' => $user->id]);

                $message_type = 'info';
                $message = '<strong>Sucesso!</strong><br><p>Já existe um usuário com o email <strong>'.$row->email.'</strong>.<br>O usuário foi vinculado com sucesso à <strong>'.$row->nome.'</strong></p>';
            }
            elseif($user->id == $row->user_id) 
            {
                $message_type = 'warning';
                $message = '<strong>Aviso!</strong><br><p>O usuário para <strong>'.$row->nome.'</strong> já está cadastrado no sistema</p>';
            }
            else
            {
                if(!empty($row->nome) && !empty($row->email))
                {
                    $user = array();
                    $user['name'] = $row->nome;
                    $user['email'] = $row->email;
                    $user['password'] = '123456';

                    $t = new AuthController();
                    $user = $t->create($user);

                    $row->update(['user_id' => $user->id]);

                    $message_type = 'info';
                    $message = '<strong>Sucesso!</strong><br><p>O usuário para <strong>'.$row->nome.'</strong> foi criado.</p>';
                }
                else 
                {
                    $message_type = 'danger';
                    $message = '<strong>Erro!</strong><br><p>Não foi possível gerar o usuário! É necessário que o registro tenha nome e email.</p>';
                }
            }
        }

        return back()->with(compact('message_type','message'));
    }

}
