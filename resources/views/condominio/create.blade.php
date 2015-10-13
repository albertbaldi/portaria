@extends('app')

@section('content')

<h4>Novo Condomínio</h4>

<p>
	<a href="{!! route('admin.condominio.index') !!}">cancelar</a>
</p>

{!! Form::open(['route' => 'admin.condominio.store']) !!}

@include('condominio.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection