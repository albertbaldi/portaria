@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Detalhes da Unidade</h4>
				</div>
				<div class="panel-body">
					Condomínio: <strong>{!! $row->bloco->condominio->nome !!}</strong><br>
					Bloco: <strong>{!! $row->bloco->numero !!}</strong><br>
					Unidade: <strong>{!! $row->numero !!}</strong><br>
					@if($row->visitas->count())
					Visitas: <strong>{!! $row->visitas->count() !!}</strong> (<a href="{!! action('VisitaController@index') !!}">visualizar</a>)<br>
					@endif
					<br>
					<div class="panel panel-default">
						<div class="panel-heading">Moradores (<a href="{!! action('MoradorController@index') !!}">editar</a>)</div>
						<div class="panel-body">
							@foreach ($row->moradores as $morador)
							<strong>
								<p>{!! $morador->nome !!} {!! $morador->responsavel ? ' (responsável)' : '' !!}</p>
							</strong>
							@endforeach
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection