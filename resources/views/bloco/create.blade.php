@extends('app')

@section('content')

<h4>Novo Bloco</h4>

<p>
	<a href="{!! route('bloco.index', [$row->condominio_id]) !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => 'bloco.store']) !!}

@include('bloco._form')

{!! Form::close() !!}

@endsection