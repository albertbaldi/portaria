@extends('app')

@section('content')

<h4>Editar Condomínio</h4>

<p>
	<a href="{!! route('condominio.index') !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['condominio.update', $row->id]]) !!}

@include('condominio._form')

{!! Form::close() !!}

@endsection