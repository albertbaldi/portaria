@extends('app')

@section('content')

<h4>Nova Unidade</h4>

<p>
	<a href="{{ route('admin.condominio.index', [$row->bloco_id])}}">cancelar</a>
</p>

{!! Form::open(['route' => 'admin.condominio.store']) !!}

@include('unidade.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection