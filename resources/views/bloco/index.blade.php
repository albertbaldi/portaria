@extends('app')

@section('content')

<h4>
	<small>{!! $condominio->nome !!}</small>
	<br>
	Blocos do Condomínio
</h4>

<p>
	<a href="{!! route('admin.condominio.index') !!}">voltar</a> |
	<a href="{!! route('admin.bloco.create', [$condominio->id]) !!}">novo</a>
</p>
@if($rows->count())
<div class="panel panel-default">
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Número</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($rows as $row)
			<tr>
				<td>{!! $row->numero !!}</td>
				<td style="width:1%; white-space: nowrap;">
					<a href="{!! route('admin.bloco.edit', [$row->id]) !!}">editar</a> | 
					<a href="{!! route('admin.unidade.index', [$row->id]) !!}">unidades</a>
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