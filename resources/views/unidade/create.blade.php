@extends('app')

@section('content')

<h4>
	<small>{{$row->bloco->condominio->nome}} - {{$row->bloco->numero}}</small>
	<br>
	Nova Unidade
</h4>

<p>
	<a href="{{ route('admin.unidade.index', [$row->bloco_id])}}">cancelar</a>
</p>

{!! Form::open(['route' => 'admin.unidade.store']) !!}

@include('unidade.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection