@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-{{$type}}">
				<div class="panel-heading text-uppercase">
					<strong>{!! $title !!}</strong>
				</div>
				<div class="panel-body">
					<p>{!! $message !!}</p>
					<p>{!! $detail or '' !!}</p>
				</div>
				<div class="panel-footer text-right">
					<a class="btn btn-sm btn-default" href="{!! url('/auth/logout') !!}">OK</a>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection