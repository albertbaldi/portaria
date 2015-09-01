@extends('app')

@section('content')

<h4>{!! $row->id > 0 ? 'Editar' : 'Novo' !!} Bloco</h4>

<p>
	<a href="{!! route('blocos', [$row->condominio_id]) !!}">cancelar</a>
</p>

<form action="" class="form" method="POST">
	<input type="hidden" name="_token" value="{{{ csrf_token()  }}}" />
	<input type="hidden" name="_method" value="{!! ($row->id > 0 ? 'POST' : 'PUT') !!}">
	<input type="hidden" name="condominio_id" value="{!! { $row->condominio_id  !!}}" />
	<input type="hidden" name="id" value="{!! { $row->id  !!}}" />

	<div class="form-group">
		<label for="">Número</label>
		<input type="text" class="form-control" name="numero" value="{!! $row->id == 0 ? old('numero') : $row->numero  !!}">
	</div>

	<button class="btn btn-primary btn-block">gravar</button>
</form>
@endsection