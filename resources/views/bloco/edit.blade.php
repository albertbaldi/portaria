@extends('app')

@section('content')

<h4>
	<small>{!! $row->condominio->nome !!}</small>
	<br>
	Editar Bloco
</h4>

<p>
	<a href="{!! route('admin.bloco.index', [$row->condominio_id]) !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['admin.bloco.update', $row->id]]) !!}

@include('bloco.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}


@endsection