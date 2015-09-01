@extends('app')

@section('content')

<h4>
	<small>
		{!! Auth::user()->funcionario->condominio->nome !!}
	</small>
	<br>
	{!! $row->id > 0 ? 'Editar' : 'Nova' !!} Visita
</h4>
<p>
	<a href="{!! action('VisitaController@index') !!}">cancelar</a>
</p>

<form action="" class="form" method="POST">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="hidden" name="_method" value="{!! ($row->id > 0 ? 'POST' : 'PUT') !!}">
	<input type="hidden" name="id" value="{{{ $row->id }}}" />

	<div class="form-group">
		<label class="control-label">Bloco</label>
		<select name="bloco" id="ComboBloco" class="form-control" style="width: 120px;">
			<option value="0">Selecione</option>
			@foreach ($blocos as $bloco)
			<option value="{!! $bloco->id !!}">{!! $bloco->numero !!}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label class="control-label">Unidade</label>
		<select name="unidade_id" id="ComboUnidade" class="form-control" style="width: 100px;">
			<option></option>
		</select>
	</div>

	<div class="form-group">
		<label for="">Data/Hora Entrada</label>
		<div class="input-group" style="width: 100px;">
			<input type="text" class="form-control date_time" name="data_entrada" style="width: 170px;" value="{!! empty(old('data_entrada')) ? $row->data_entrada : old('data_entrada') !!}">
			<span class="input-group-btn">
				<button class="btn btn-default defineDateTime" target="data_entrada" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
			</span>
		</div>
	</div>

	<div class="form-group">
		<label for="">Data/Hora Saída</label>
		<div class="input-group" style="width: 100px;">
			<input type="text" class="form-control date_time" name="data_saida" style="width: 170px;" value="{!! empty(old('data_saida')) ? $row->data_saida : old('data_saida') !!}">
			<span class="input-group-btn">
				<button class="btn btn-default defineDateTime" target="data_saida" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
			</span>
		</div>
	</div>

	<div class="form-group">
		<label for="">Placa</label>
		<input type="text" class="form-control placa text-uppercase" name="placa" style="width: 90px;" value="{!! empty(old('placa')) ? $row->placa : old('placa') !!}">
	</div>

	<button class="btn btn-primary btn-block">gravar</button>
</form>
@endsection