@extends('app')

@section('content')

<p>
	<a href="{!! route('admin.funcionario.index', [$row->condominio_id]) !!}">cancelar</a>
</p>
<h4>
	<small>{!! $row->condominio->nome !!}</small>
	<br>
	Novo Funcionário
</h4>

{!! Form::model($row, ['route' => 'admin.funcionario.store']) !!}

@include('funcionario.partial.form')

{!! Form::submit('Gravar', ['class' => 'btn btn-block btn-primary']) !!}
{!! Form::close() !!}

@endsection