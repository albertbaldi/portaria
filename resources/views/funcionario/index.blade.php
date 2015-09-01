@extends('app')

@section('content')

<h4>
	<small>{!! $condominio->nome !!}</small>
	<br>
	Funcionários do Condomínio
</h4>

<p>
	<a href="{!! route('condominio.index') !!}">voltar</a> |
	<a href="{!! action('FuncionarioController@create', [$condominio->id]) !!}">novo</a>
</p>
@if($rows->count())
<table class="table table-hover table-striped records">
	<thead>
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Ativo</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			<td>{!! $row->nome !!} {!! $row->sindico ? '(síndico)' : '' !!}</td>
			<td>{!! $row->email !!}</td>
			<td>{!! $row->ativo ? 'Sim' : 'Não' !!}</td>
			<td>
				@if(empty($row->user_id))
				<a href="{!! action('UsuarioController@createUser', ['f', $row->id]) !!}">gerar usuário</a> |
				@endif
				@if($row->ativo)
				<a href="{!! action('FuncionarioController@deactivate', [$row->id]) !!}">desativar</a> |
				@endif
				<a href="{!! route('funcionario.edit', [$row->id]) !!}">editar</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div class="text-center">
	{!! $rows->render() !!}
</div>
@else
@include('utils.norecords')
@endif

@endsection