@extends('app')

@section('content')

<h4>{!! $row->id > 0 ? 'Editar' : 'Novo' !!} Morador</h4>

<p>
	@if(Auth::user()->tipoUsuario == 'M')
	<a href="{!! action('MoradorController@index') !!}">cancelar</a>
	@else
	<a href="{!! action('MoradorController@index') !!}">cancelar</a>
	@endif

	@if(empty($row->user_id) && !empty($row->email) && $row->id > 0)
	| <a href="{!! action('UsuarioController@createUser', ['m', $row->id]) !!}">gerar usuário</a> |
	@endif
</p>
<form action="" class="form" method="POST">
	<input type="hidden" name="_token" value="{{{ csrf_token()  }}}" />
	<input type="hidden" name="_method" value="{!! ($row->id > 0 ? 'POST' : 'PUT') !!}">
	<input type="hidden" name="id" value="{{{ $row->id  }}}" />

	@if(Auth::user()->tipoUsuario == 'M')
	<input type="hidden" name="unidade_id" value="{{{ $row->unidade_id  }}}" />
	@else
	<div class="form-group">
		<label class="control-label">Bloco</label>
		{!! Form::select('bloco', $blocos, $row->id == 0 ? null : $row->unidade->bloco_id , ['id'=>'ComboBloco', 'class'=>'form-control', 'style'=>'width:120px;']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">Unidade</label>
		{!! Form::select('unidade_id', $unidades, $row->id == 0 ? null : $row->unidade_id , ['id'=>'ComboUnidade', 'class'=>'form-control', 'style'=>'width:100px;']) !!}
	</div>
	@endif

	<div class="form-group">
		<label for="">Nome</label>
		<input type="text" class="form-control" name="nome" value="{!! $row->id == 0 ? old('nome') : $row->nome  !!}">
	</div>
	<div class="form-group">
		<label for="">CPF</label>
		<input type="text" class="form-control cpf" style="width: 130px;" name="cpf" value="{!! $row->id == 0 ? old('cpf') : $row->cpf  !!}">
	</div>
	<div class="form-group">
		<label for="">Data Nascimento</label>
		<input type="text" class="form-control date" style="width: 105px;" name="data_nascimento" value="{!! $row->id == 0 ? old('data_nascimento') : $row->data_nascimento  !!}">
	</div>
	<div class="form-group">
		<label for="">Email</label>
		<input type="text" class="form-control text-lowercase" name="email" value="{!! $row->id == 0 ? old('email') : $row->email  !!}">
	</div>
	<div class="form-group">
		<label for="">Telefone</label>
		<input type="text" class="form-control telefone" style="width: 120px;" name="telefone" value="{!! $row->id == 0 ? old('telefone') : $row->telefone  !!}">
	</div>
	<div class="form-group">
		<label for="">Celular</label>
		<input type="text" class="form-control telefone" style="width: 120px;" name="celular" value="{!! $row->id == 0 ? old('celular') : $row->celular  !!}">
	</div>

	<button class="btn btn-primary btn-block">gravar</button>
</form>
@endsection