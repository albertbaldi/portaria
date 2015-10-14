<div class="row">
	<div class="col-md-2 form-group">
		{!! Form::label('bloco', 'Bloco', ['class' => 'form-label']) !!}
		{!! Form::select('bloco', \portaria\Bloco::where('condominio_id', \Auth::user()->funcionario->condominio_id)->lists('numero', 'id'), null, ['class' => 'form-control','style' =>'width: 100px;', 'id' => 'ComboBloco']) !!}
	</div>
	<div class="col-md-2 form-group">
		{!! Form::label('unidade_id', 'Unidade', ['class' => 'form-label']) !!}
		{!! Form::select('unidade_id', [], null, ['class' => 'form-control','style' =>'width: 100px;', 'id' => 'ComboUnidade']) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('data_entrada', 'Data/Hora Entrada', ['class' => 'form-label']) !!}
		<div class="input-group" style="width: 100px;">
			{!! Form::text('data_entrada', null, ['class' => 'form-control date_time', 'style' =>'width: 170px;', 'id' => 'data_entrada']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default defineDateTime" target="data_entrada" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
			</span>
		</div>
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('data_saida', 'Data/Hora Saída', ['class' => 'form-label']) !!}
		<div class="input-group" style="width: 100px;">
			{!! Form::text('data_saida', null, ['class' => 'form-control date_time', 'style' =>'width: 170px;', 'id' => 'data_saida']) !!}
			<span class="input-group-btn">
				<button class="btn btn-default defineDateTime" target="data_saida" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
			</span>
		</div>
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('placa', 'Placa', ['class' => 'form-label']) !!}
		{!! Form::text('placa', null, ['class' => 'form-control placa text-uppercase', 'style' => 'width: 110px;',  'id' => 'placa']) !!}
	</div>
</div>

