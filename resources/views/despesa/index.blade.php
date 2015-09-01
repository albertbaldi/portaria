@extends('app')

@section('content')

<h4>
	<small>{{$condominio->nome}}</small>
	<br>
	Despesas do Condomínio
</h4>

<form action="" class="form-inline" method="POST">
	<div class="form-group">
		<input type="text" class="form-control date" name="data_inicio" placeholder="Data início">
	</div>
	<div class="form-group">
		<input type="text" class="form-control date" name="data_fim" placeholder="Data fim">
	</div>
	<button class="btn btn-default">Filtrar</button>
</form>
@endsection