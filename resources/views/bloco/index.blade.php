@extends('app')

@section('content')

<h4>
	<small>{!! $condominio->nome !!}</small>
	<br>
	Blocos do Condomínio
</h4>

<p>
	<a href="{!! route('condominio.index') !!}">voltar</a> |
	<a href="{!! route('bloco.create', [$condominio->id]) !!}">novo</a>
</p>
@if($rows->count())
<table class="table table-hover table-striped records">
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
			<td>
				<a href="{!! route('bloco.edit', [$row->id]) !!}">editar</a> | 
				<a href="{!! route('unidade.index', [$row->id]) !!}">unidades</a>
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