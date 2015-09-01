@extends('app')

@section('content')

<h4>
	<small>
		@if(Auth::user()->tipoUsuario == 'M' )
		{!! $row->bloco->condominio->nome !!} - {!! $row->bloco->numero !!}/{!! $row->numero !!}
		@else
		{!! $row->nome !!}
		@endif
	</small>
	<br>
	Moradores {!! Auth::user()->tipoUsuario == 'M' ? 'da Unidade' : 'do Condomínio' !!}
</h4>

<p>
	<a href="{!! action('MoradorController@create') !!}">novo</a>
</p>
@if($rows->count())
<table class="table table-hover table-striped records">
	<thead>
		<tr>
			@if(Auth::user()->tipoUsuario == 'F')
			<th>UNIDADE</th>
			@endif
			<th>NOME</th>
			<th>EMAIL</th>
			<th>TELEFONE</th>
			<th>CELULAR</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			@if(Auth::user()->tipoUsuario == 'F')
			<td>
				<a href="{!! action('MoradorController@create', [$row->unidade_id]) !!}">
					{!! $row->bloco !!}/{!! $row->unidade !!}
				</a>
			</td>
			@endif
			<td>{!! $row->nome !!}</td>
			<td>{!! $row->email !!}</td>
			<td>{!! $row->telefone !!}</td>
			<td>{!! $row->celular !!}</td>
			<td>
				@if(empty($row->user_id) && !empty($row->email))
				<a href="{!! action('UsuarioController@createUser', ['m', $row->id]) !!}">gerar usuário</a> |
				@endif
				<a href="{!! action('MoradorController@edit', [$row->id]) !!}">editar</a>
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