@extends('app')

@section('content')

<h4>
	<small>{{$bloco->condominio->nome}} - {{$bloco->numero}}</small>
	<br>
	Unidades do Bloco
</h4>

<p>
	<a href="{{ route('admin.bloco.index', [$bloco->condominio_id])}}">voltar</a> |
	<a href="{{ route('admin.unidade.create', [$bloco->id])}}">novo</a>
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
				<td>{{$row->numero}}</td>
				<td style="width:1%; white-space: nowrap;">
					<a href="{{ route('admin.unidade.edit', [$row->id])}}">editar</a> |
					<a href="#" class="openDetails" data-id="{!! $row->id !!}">moradores</a>
				</td>
			</tr>
			<tr id="details_{!! $row->id !!}" style="display: none;">
				<td colspan="2">
					@foreach ($row->moradores as $morador)
					{!! $morador->nome !!} <br>
					@endforeach
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