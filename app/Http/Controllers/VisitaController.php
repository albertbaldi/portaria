<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

use portaria\Visita;

class VisitaController extends Controller
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

            $rows = \portaria\Visita::where('unidade_id', \Auth::user()->morador->unidade_id)->
            orderBy('data_entrada', 'desc')->
            paginate(10);

        } else {

            $row = \Auth::user()->funcionario->condominio;

            $rows = \portaria\Visita::select([
                'visitas.id',
                'visitas.data_entrada',
                'visitas.data_saida',
                'visitas.placa',
                'blocos.id AS bloco_id',
                'blocos.numero AS bloco',
                'unidades.id AS unidade_id',
                'unidades.numero AS unidade'
                ])->
            join('unidades', function ($join) {
                $join->on('unidades.id', '=', 'visitas.unidade_id');
            })->
            join('blocos', function ($join) {
                $join->on('blocos.id', '=', 'unidades.bloco_id');
            })->
            where('blocos.condominio_id', '=', \Auth::user()->funcionario->condominio_id)->
            orderBy('blocos.id')->
            orderBy('unidades.id')->
            orderBy('visitas.data_entrada', 'desc')->
            paginate(10);

        }
        
        return view('visita.index')->with(compact('row', 'rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $condominio = \Auth::user()->funcionario->condominio;
        $blocos = \portaria\Bloco::where('condominio_id', $condominio->id)->get();

        $row = new Visita();
        return view('visita.form')->with(compact('blocos', 'row'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $visita = \portaria\Visita::create($request::all());

        return $this->getReturn();
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
        $row = \portaria\Visita::find($id);

        return view('visita.form')->with(compact('row'));
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
        $row = \portaria\Visita::find($id);
        $row->update($request::all());

        return $this->getReturn();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        \portaria\Visita::destroy($id);

        return back();
    }

    public function checkout($id)
    {
        $data = date('d/m/Y H:i:s');
        $row = \portaria\Visita::find($id);
        $row->update(['data_saida' => $data]);

        $msg = 'A visita #'.$row->id.' foi finalizada em '.$data;
        return back()->with('message', $msg);
    }

    protected function getReturn()
    {
        $tipoUsuario = \Auth::user()->tipoUsuario;
        switch ($tipoUsuario) {
            case 'M':
            return redirect()->route('morador_visitas');
            break;
            case 'F':
            return redirect()->action('VisitaController@index');
            break;
        }     
    }
}
