@extends('app')

@section('content')

<h4>Condomínios</h4>

<p>
	<a href="{!! route('admin.condominio.create') !!}">novo</a>
</p>

@if($rows->count())
<div class="panel panel-default">
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nome</th>
				<th>CNPJ</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($rows as $row)
			<tr>
				<td>{!! $row->nome !!}</td>
				<td>{!! $row->cnpj !!}</td>
				<td style="width:1%; white-space: nowrap;">
					@if(!$row->blocos->count())
					<a href="{!! route('admin.condominio.createStructure', [$row->id]) !!}">gerar estrutura</a> |
					@endif
					<a href="{!! route('admin.funcionario.index', [$row->id]) !!}">funcionários</a> | 
					<a href="{!! route('admin.condominio.edit', [$row->id]) !!}">editar</a> | 
					<a href="{!! route('admin.bloco.index', [$row->id]) !!}">blocos</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="text-center">
	{!! $rows->render() !!}
</div>
@else
@include('utils.norecords')
@endif

@endsection