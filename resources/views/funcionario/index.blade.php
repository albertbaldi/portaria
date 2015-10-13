@extends('app')

@section('content')

<h4>
	<small>{!! $condominio->nome !!}</small>
	<br>
	Funcionários do Condomínio
</h4>

<p>
	<a href="{!! route('admin.condominio.index') !!}">voltar</a> |
	<a href="{!! route('admin.funcionario.create', [$condominio->id]) !!}">novo</a>
</p>
@if($rows->count())
<div class="panel panel-default">
	
	<table class="table table-hover">
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
				<td>{!! strtolower($row->email) !!}</td>
				<td>{!! $row->ativo ? 'Sim' : 'Não' !!}</td>
				<td style="width:1%; white-space: nowrap;text-align: right;">
					@if(empty($row->user_id))
					<a href="{!! route('create_user', ['f', $row->id]) !!}">gerar usuário</a> |
					@endif
					@if($row->ativo)
					<a href="{!! route('admin.funcionario.deactivate', [$row->id]) !!}">desativar</a> |
					@endif
					<a href="{!! route('admin.funcionario.edit', [$row->id]) !!}">editar</a>
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