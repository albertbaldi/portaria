@extends('app')

@section('content')
<div class="alert alert-danger">
	<strong>Erro!</strong><br>
	O usuário informado não possui acesso ao sistema ou está desativado.
</div>
<a href="{!! url('/auth/logout') !!}">Voltar</a>
@endsection
