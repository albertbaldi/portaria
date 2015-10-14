@extends('app')

@section('content')

<h4>
	<small>
		{!! Auth::user()->funcionario->condominio->nome !!}
	</small>
	<br>
	Editar Visita
</h4>
<p>
	<a href="{!! route('visita.index') !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['funcionario.visita.update', $row->id]]) !!}

@include('visita.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection