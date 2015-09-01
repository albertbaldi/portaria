<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

use portaria\Morador;

class MoradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tipoUsuario = \Auth::user()->tipoUsuario;

        if($tipoUsuario == 'M')
        {
            $row = \Auth::user()->morador->unidade;
            $rows = \portaria\Morador::where('unidade_id', \Auth::user()->morador->unidade_id)->paginate(5);
        } else {

          $row = \Auth::user()->funcionario->condominio;
          $rows = \portaria\Morador::select([
            'moradores.id',
            'moradores.nome',
            'moradores.email',
            'moradores.telefone',
            'moradores.celular',
            'moradores.email',
            'moradores.user_id',
            'blocos.id AS bloco_id',
            'blocos.numero AS bloco',
            'unidades.id AS unidade_id',
            'unidades.numero AS unidade'
            ])->join('unidades', function ($join) {
                $join->on('unidades.id', '=', 'moradores.unidade_id');
            })->join('blocos', function ($join) {
                $join->on('blocos.id', '=', 'unidades.bloco_id');
            })->where('blocos.condominio_id', '=', \Auth::user()->funcionario->condominio_id)->
            orderBy('blocos.id')->
            orderBy('unidades.id')->
            orderBy('moradores.nome')->
            paginate(10);
        } 

        return view('morador.index')->with(compact('row', 'rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $row = new Morador();
        $user = \Auth::user();

        if($user->tipoUsuario == 'M')
            $row->unidade_id = $user->morador->unidade_id;

        $blocos = $this->getBlocos();
        $unidades = $this->getUnidades($blocos->first());

        return view('morador.form')->with(compact('row', 'blocos', 'unidades'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $morador = \portaria\Morador::create($request::all());

        return redirect()->action('MoradorController@index');
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
        $row = \portaria\Morador::find($id);
        $blocos = $this->getBlocos();
        $unidades = $this->getUnidades($row->unidade->bloco->id);

        return view('morador.form')->with(compact('row', 'blocos', 'unidades'));
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
        $row = \portaria\Morador::find($id);
        $row->update($request::all());
        
        return redirect()->action('MoradorController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        \portaria\Morador::destroy($id);

        return back();
    }

    protected function getReturn()
    {
        $tipoUsuario = \Auth::user()->tipoUsuario;
        switch ($tipoUsuario) {
            case 'M':
            return redirect()->route('morador_moradores');
            break;
            case 'F':
            return redirect()->route('funcionario_moradores');
            break;
        }     
    }

    protected function getBlocos()
    {
        $user = \Auth::user();
        if($user->tipoUsuario == 'M')
        {
            $blocos = \portaria\Bloco::where('condominio_id', $user->morador->bloco->condominio->id)->lists('numero', 'id');
        } else {
            $blocos = \portaria\Bloco::where('condominio_id', $user->funcionario->condominio->id)->lists('numero', 'id');
        }
        return $blocos;
    }

    protected function getUnidades($id)
    {
        $unidades = \portaria\Unidade::where('bloco_id', $id)->lists('numero', 'id');

        return $unidades;
    }

    public function getByUnidade()
    {
        $unidade = \Auth::user()->morador->unidade;

        $rows = \portaria\Morador::where('unidade_id', $unidade->id)->get();

        return view('morador.index', ['unidade' => $unidade, 'rows' => $rows]);
    }
}
