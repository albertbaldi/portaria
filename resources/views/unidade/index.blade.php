@extends('app')

@section('content')

<h4>
	<small>{{$bloco->condominio->nome}} - {{$bloco->numero}}</small>
	<br>
	Unidades do Bloco
</h4>

<p>
	<a href="{{ route('blocos', [$bloco->condominio_id])}}">voltar</a> |
	<a href="{{ route('unidade_create', [$bloco->id])}}">novo</a>
</p>
@if($rows->count())
<table class="table table-bordered table-hover table-striped records">
	<thead>
		<tr>
			<th>NUMERO</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			<td>{{$row->numero}}</td>
			<td>
				<a href="{{ route('unidade_edit', [$row->id])}}">editar</a>
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