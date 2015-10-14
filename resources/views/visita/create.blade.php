@extends('app')

@section('content')

<h4>
	<small>
		{!! Auth::user()->funcionario->condominio->nome !!}
	</small>
	<br>
	Nova Visita
</h4>
<p>
	<a href="{!! route('visita.index') !!}">cancelar</a>
</p>

{!! Form::open(['route' => 'funcionario.visita.store']) !!}

@include('visita.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection