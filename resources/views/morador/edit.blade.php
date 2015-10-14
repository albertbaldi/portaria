@extends('app')

@section('content')

<h4>
	<small>{{$row->unidade->bloco->condominio->nome}} - {{$row->bloco->numero}} - {{$row->numero}}</small>
	<br>
	Editar Morador
</h4>

<p>
	<a href="{{ route('morador.index', [$row->unidade_id])}}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['morador.update', $row->id]]) !!}

@include('morador.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection