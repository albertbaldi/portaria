@extends('app')

@section('content')

<h4>Editar Condomínio</h4>

<p>
	<a href="{!! route('admin.condominio.index') !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['admin.condominio.update', $row->id]]) !!}

@include('condominio.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}


@endsection