@extends('app')

@section('content')

<h4>
	<small>{{$row->bloco->condominio->nome}} - {{$row->bloco->numero}}</small>
	<br>
	Editar Unidade
</h4>

<p>
	<a href="{{ route('admin.unidade.index', [$row->bloco_id])}}">cancelar</a>
</p>

{!! Form::model($row, ['route' => ['admin.unidade.update', $row->id]]) !!}

@include('unidade.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection