@extends('app')

@section('content')

<h4>Novo Condomínio</h4>

<p>
	<a href="{!! route('condominio.index') !!}">cancelar</a>
</p>

{!! Form::open(['route' => 'condominio.store']) !!}

@include('condominio._form')

{!! Form::close() !!}

@endsection