@extends('app')

@section('content')

<h4>Condomínios</h4>

<p>
	<a href="{!! route('condominio.create') !!}">novo</a>
</p>
@if($rows->count())
<table class="table table-hover table-striped records">
	<thead>
		<tr>
			<th>Nome</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			<td>{!! $row->nome !!}</td>
			<td>
				@if(!$row->blocos->count())
				<a href="{!! route('condominio.createStructure', [$row->id]) !!}">gerar estrutura</a> |
				@endif
				<a href="{!! route('funcionario.index', [$row->id]) !!}">funcionários</a> | 
				<a href="{!! route('condominio.edit', [$row->id]) !!}">editar</a> | 
				<a href="{!! route('bloco.index', [$row->id]) !!}">blocos</a>
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