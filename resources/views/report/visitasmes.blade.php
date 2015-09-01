@extends('app')

@section('content')


<div class="panel panel-default">
	<div class="panel-heading text-center">
		<strong>
			Relatório - Visitas  
			<br>
			{{\DateTime::createFromFormat("Y-m-d H:i:s", $params[0])->format("d/m/Y")}} até {{\DateTime::createFromFormat("Y-m-d H:i:s", $params[1])->format("d/m/Y")}}
			<br>
			<small>{{Auth::user()->funcionario->condominio->nome}}</small>
		</strong>
	</div>
	<div class="panel-body">
		@if($rows->count())
		<p class="text-right">
			{{Date('d/m/Y H:i:s')}}<br>
			Total de registros: {{$rows->count()}}
		</p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="width: 80px;">UNIDADE</th>
					<th>NOME</th>
					<th>TELEFONE</th>
					<th>CELULAR</th>
					<th>EMAIL</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($rows as $row)
				<tr>
					<td>{{$row->unidade->bloco->numero}}/{{$row->unidade->numero}}</td>
					<td>{{$row->nome}}</td>
					<td>{{$row->telefone}}</td>
					<td>{{$row->celular}}</td>
					<td>{{$row->email}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		@include('utils.norecords')
		@endif
	</div>
</div>

@endsection