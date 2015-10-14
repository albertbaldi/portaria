@extends('app')

@section('content')

<h4>
	<small>{{$row->unidade->bloco->condominio->nome}} - {{$row->bloco->numero}} - {{$row->numero}}</small>
	<br>
	Novo Morador
</h4>

<p>
	<a href="{{ route('morador.index', [$row->unidade_id])}}">cancelar</a>
</p>

{!! Form::open(['route' => 'morador.store']) !!}

@include('morador.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection