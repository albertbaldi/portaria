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
	Visitas {!! Auth::user()->tipoUsuario == 'M' ? 'da Unidade' : 'do Condomínio' !!}
</h4>

<p>
	@if(Auth::user()->tipoUsuario == 'F')
	<a href="{!! action('VisitaController@create') !!}">novo</a>
	@endif
</p>
@if($rows->count())
<table class="table table-hover table-striped records">
	<thead>
		<tr>
			@if(Auth::user()->tipoUsuario == 'F')
			<th>Unidade</th>
			@endif
			<th>Data Entrada</th>
			<th>Data Saída</th>
			<th>Placa</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			@if(Auth::user()->tipoUsuario == 'F')
			<td>{!! $row->bloco !!}/{!! $row->unidade !!}</td>
			@endif
			<td>{!! $row->data_entrada !!}</td>
			<td>{!! $row->data_saida !!}</td>
			<td>{!! $row->placa !!}</td>
			<td>
				@if(Auth::user()->tipoUsuario == 'F')
				@if(empty($row->data_saida))
				<a href="{!! action('VisitaController@checkout', [$row->id]) !!}">finalizar</a> |
				@endif
				<a href="{!! action('VisitaController@edit', [$row->id]) !!}">editar</a>
				@endif
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