@extends('app')

@section('content')

<h4>{{$row->id > 0 ? 'Editar' : 'Novo'}} Unidade</h4>

<p>
	<a href="{{ route('unidades', [$row->bloco_id])}}">cancelar</a>
</p>

{!! Form::model($row, ['route' => 'condominio.update', $row->id]) !!}
@include('unidade._form')
<br>
<button class="btn btn-primary btn-block">gravar</button>
{!! Form::close() !!}

@endsection