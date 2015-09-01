@extends('app')

@section('content')


<p>
	<a href="{!! route('funcionario.index', [$row->condominio_id]) !!}">cancelar</a>
</p>
<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h4>
			Novo Funcionário
		</h4>
	</div>

	{!! Form::model($row, ['route' => 'funcionario.store']) !!}

	@include('funcionario._form')

	{!! Form::close() !!}
</div>
@endsection