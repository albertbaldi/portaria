@extends('app')

@section('content')

<p>
</p>
<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h4>
			Editar Funcionário
		</h4>
	</div>

	{!! Form::model($row, ['route' => ['funcionario.update', $row->id]]) !!}

	@include('funcionario._form')

	{!! Form::close() !!}
</div>
@endsection