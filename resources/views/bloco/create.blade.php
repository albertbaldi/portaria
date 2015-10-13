@extends('app')

@section('content')

<h4>Novo Bloco</h4>

<p>
	<a href="{!! route('admin.bloco.index', [$row->condominio_id]) !!}">cancelar</a>
</p>

{!! Form::model($row, ['route' => 'admin.bloco.store']) !!}

@include('bloco.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection