<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

use portaria\Condominio;

class CondominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rows = \portaria\Condominio::paginate(10);

        return view('condominio.index')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('condominio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        \portaria\Condominio::create($request::all());

        return redirect('/');
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
        $row = \portaria\Condominio::find($id);

        return view('condominio.edit')->with(compact('row'));
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
        $row = \portaria\Condominio::find($id);
        $row->update($request::all());

        return redirect()->action('CondominioController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        \portaria\Condominio::destroy($id);

        return back();
    }

    public function createStructure($id)
    {
        $blocosGerados = 0;
        $unidadesGeradas = 0;

        $blocos = \portaria\Bloco::where('condominio_id', $id)->first();
        if(!empty($blocos))
        {
            $condominio = \portaria\Condominio::find($id);
            $message_type = 'danger';
            $message = '<strong>Erro!</strong><br><p>A estrutura para o condomínio <strong>'.$condominio->nome.'</strong> já está gerada!</p>';
        }else {
            for ($i=1; $i <= 10; $i++) { 
                $bloco = \portaria\Bloco::create(['numero' => $i, 'condominio_id' => $id]);
                $blocosGerados++;

                for ($x=100; $x <= 400; $x+=100) { 
                    for ($y=1; $y <= 4; $y++) { 
                        $numero = $x + $y;
                        
                        $unidade = \portaria\Unidade::create(['bloco_id' => $bloco->id, 'numero' => $numero]);
                        $unidadesGeradas++;
                    }
                }
            }

            $message_type = 'info';
            $message = '<strong>Sucesso!</strong><br><p>Foi gerado a seguinte estrutura: <strong>'.$blocosGerados.'</strong> blocos e <strong>'.$unidadesGeradas.'</strong> unidades';
        }

        return back()->with(compact('message_type', 'message'));
    }
}
