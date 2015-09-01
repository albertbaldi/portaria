<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

use portaria\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $condominio = \portaria\Condominio::find($id);
        $rows = \portaria\Funcionario::where('condominio_id', $id)->paginate(10);

        return view('funcionario.index')->with(compact('condominio', 'rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        $row = new Funcionario();
        $row->condominio_id = $id;

        return view('funcionario.create')->with(compact('row'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $message_type = 'warning';
        $message = $this->checkExistsSindico($request);
        if(empty($message))
        {
            $row = \portaria\Funcionario::create($request::all());
            return redirect()->route('funcionario.index', [$row->condominio_id]);
        } else {
            return back()->with(compact('message_type', 'message'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $row = \portaria\Funcionario::find($id);

        return view('funcionario.edit')->with(compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $message_type = 'warning';
        $message = $this->checkExistsSindico($request, $id);

        if(empty($message))
        {
            $row = \portaria\Funcionario::find($id);
            $row->update($request::all());

            return redirect()->route('funcionario.index', [$row->condominio_id]);
        } else {
            return back()->with(compact('message_type', 'message'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function deactivate($id)
    {
        $row = \portaria\Funcionario::find($id);
        $row->update(['ativo' => false]);
        
        $message_type = 'info';
        $message = '<strong>Sucesso</strong><br><br>O funcionário <strong>'.$row->nome.'<strong> foi desativado com sucesso!';
        return redirect()->route('funcionario.index', [$row->condominio_id])->with(compact('message_type', 'message'));
    }

    protected function checkExistsSindico(Request $request, $id)
    {
        if($request::Input('sindico'))
        {
            $condominio = \portaria\Condominio::find($request::Input('condominio_id'));
            $row = \portaria\Funcionario::where('condominio_id', $request::Input('condominio_id'))->where('id', '<>', $id)->where('sindico', true)->first();
            if(!empty($row))
                return '<strong>Atenção</strong><br><br>O condomínio <strong>'.$condominio->nome.'</strong> já possui o funcionário <strong>'.$row->nome.'</strong> definido como síndico!';
        }
        return null;

    }

    public function getByLoggedUser()
    {
        $condominio = \Auth::user()->funcionario->condominio;
        
        return $this->index($condominio->id);
    }

}
