@extends('app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="alert alert-danger">
				<strong>Erro!</strong>
				<br><br>
				O usuário informado está desativado.
			</div>
			<a href="{{ url('/auth/logout') }}">Voltar</a>

		</div>
	</div>
</div>
@endsection
