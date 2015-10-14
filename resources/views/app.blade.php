<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portaria</title>

	<link href="{!! asset('/css/app.css') !!}" rel="stylesheet">
	<link href="{!! asset('/css/custom.css') !!}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="padding: 10px;">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{!! url('/') !!}">Portaria</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						@if(Auth::check())
						@if(Auth::user()->tipoUsuario == 'A')
						<li><a href="{!! route('admin.condominio.index') !!}">Condomínios</a></li>
						@elseif(Auth::user()->tipoUsuario == 'F')
						<li><a href="{!! route('morador.morador.show') !!}">Moradores</a></li>
						<li><a href="{!! route('visita.index') !!}">Visitas</a></li>

						@if(Auth::user()->funcionario->sindico)
						<li><a href="{!! route('funcionarios') !!}">Funcionários</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatórios <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{!! action('ReportController@moradores') !!}">Moradores</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="">Receitas - mês atual</a></li>
								<li><a href="">Despesas - mês atual</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="{!! action('ReportController@visitasmes') !!}">Visitas - mês atual</a></li>
							</ul>
						</li>
						@endif
						@elseif(Auth::user()->tipoUsuario == 'M')
						<li><a href="{!! action('MoradorController@index') !!}">Moradores</a></li>
						<li><a href="{!! action('VisitaController@index') !!}">Visitas</a></li>
						@endif
						@endif	
					</ul>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
						<li><a href="{!! url('/auth/login') !!}">Login</a></li>
						@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! Auth::user()->name !!} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="">
										@if(Auth::user()->tipoUsuario == 'M')
										Morador(a)
										@elseif(Auth::user()->tipoUsuario == 'F')
										Funcionário {!! Auth::user()->funcionario->sindico ? '(síndico)' : '' !!}
										@elseif(Auth::user()->tipoUsuario == 'A')
										Administrador
										@endif
									</a>
								</li>
								<li><a href="{!! url('/auth/logout') !!}">Logout</a></li>
							</ul>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">

			@if (session('message_type') && session('message'))
			<div class="alert alert-{!! session('message_type') !!}">
				{!! session('message') !!}
			</div>
			@endif

			@if (count($errors) > 0)
			<div class="alert alert-danger">
				@foreach ($errors->all() as $error)
				<p>{!! $error !!}</p>
				@endforeach
			</div>
			@endif

			@yield('content')
			
		</div>

		<!-- Scripts -->
		<script src="{!! asset('/js/jquery-2.1.4.min.js') !!}"></script>
		<script src="{!! asset('/js/bootstrap.min.js') !!}"></script>
		<script src="{!! asset('/js/jquery.mask.js') !!}"></script>
		<script src="{!! asset('/js/app.js') !!}"></script>
	</body>
	</html>
