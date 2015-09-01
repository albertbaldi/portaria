@extends('app')

@section('content')

<h4>Editar Bloco</h4>

<p>
	<a href="{!! route('bloco.index', [$row->condominio_id]) !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['bloco.update', $row->id]]) !!}

@include('bloco._form')

{!! Form::close() !!}

@endsection