<?php

namespace portaria\Http\Controllers;

use Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

use portaria\Unidade;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($bloco_id)
    {
        $bloco = \portaria\Bloco::find($bloco_id);
        $rows = \portaria\Unidade::where('bloco_id', $bloco_id)->paginate(10);

        return view('unidade.index')->with(compact('bloco', 'rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($bloco_id)
    {
        $row = new Unidade();
        $row->bloco_id = $bloco_id;

        return view('unidade.form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $unidade = \portaria\Unidade::create($request::all());

        return redirect()->action('UnidadeController@index', [$unidade->id]);
    }

    public function detail($id)
    {
        $row = \portaria\Unidade::find($id);

        return view('unidade.show', ['row' => $row]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $id = \Auth::user()->morador->unidade_id;
//        dd($id);
        $row = \portaria\Unidade::find($id);

        return view('unidade.show', ['row' => $row]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $row = \portaria\Unidade::find($id);

        return view('unidade.form', ['row' => $row]);
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
        $row = \portaria\Unidade::find($id);
        $row->update($request::all());

        return redirect()->action('UnidadeController@index', [$row->bloco_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        \portaria\Unidade::destroy($id);
        
        return back();
    }

    public function getFromBloco()
    {
        $bloco_id = Request::input('option');

        return  Unidade::where('bloco_id', $bloco_id)->get(['id','numero']);
    }
    
}
