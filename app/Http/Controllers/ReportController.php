<?php

namespace portaria\Http\Controllers;

use Illuminate\Http\Request;

use portaria\Http\Requests;
use portaria\Http\Controllers\Controller;

class ReportController extends Controller
{
	public function moradores()
	{
		$condominio_id = \Auth::user()->funcionario->condominio_id;
		
		$rows = \portaria\Morador::join('unidades', function ($join) {
			$join->on('unidades.id', '=', 'moradores.unidade_id');
		})->join('blocos', function ($join) {
			$join->on('blocos.id', '=', 'unidades.bloco_id');
		})->where('blocos.condominio_id', $condominio_id)->orderBy('blocos.numero','asc')->orderBy('unidades.numero','asc')->get();

		return view('report.moradores', ['rows' => $rows]);
	}

	public function visitasmes()
	{
		$condominio_id = \Auth::user()->funcionario->condominio_id;
		$data_inicio = Date('Y-m-01 00:00:00');
		$data_fim = Date('Y-m-t 23:59:59', strtotime($data_inicio));

		//dd($data_inicio.' '.$data_fim);
		$rows = \portaria\Visita::where('condominio_id', $condominio_id)->whereBetween('data_entrada', [$data_inicio, $data_fim])->get();
		
		return view('report.visitasmes', ['params' => [$data_inicio, $data_fim], 'rows' => $rows]);
	}
}
