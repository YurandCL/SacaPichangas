<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Saca Pichangas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/css.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/pagination.css">

	<link rel="stylesheet" type="text/css" href="css/404.css">
<!--===============================================================================================-->
	<!-- <link rel="icon" type="image/png" href="perso/images/icons/favicon.ico"/> -->
    <link rel="icon" type="image/png" href="/images/pagina/logo_sacapichangas.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="perso/css/home.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="perso/css/util.css">
	<link rel="stylesheet" type="text/css" href="perso/css/main.css">
  
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--===============================================================================================-->
</head>
<body>
<section class="after-content clearfix">
<header id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container" style="padding-top:10px !important">
		 	@if (Auth::guest())
				<a class="navbar-brand" href="{{ url('/') }}">{{config('app.name', 'Laravel')}}</a>
			@else
				<a class="navbar-brand" href="{{ url('/principal') }}">Saca Pichangas</a>
			@endif
			
		 	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="nav navbar-nav ml-auto navbar-right">
					@if (Auth::guest())
					 	<li class="nav-item">
						 	<a class="nav-link" href="{{ url('/login') }}">
						 		Iniciar Sesion
						 	</a>
					 	</li>
		     			<li class="nav-item">
						 	<a class="nav-link" href="{{ url('/register') }}">
						 		Registrarse
						 	</a>
					 	</li>
				 	@else
				 		@if (Auth::user()->tipo_usuario == 'A')
				 			<li class="nav-item">
								<a class="nav-link" href="{{ url('/canchas') }}">Inicio
									<span class="sr-only">(current)</span>
								</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" href="{{ url('/reservas') }}">Reservas</a>
							</li> -->
							<!-- <li class="nav-item">
								<a class="nav-link" href="{{ url('/contactanos') }}">Contactanos</a>
							</li>		  -->
							<li class="btn-group dropdown">
								<img src="/images/usuarios/{{ Auth::user()->ruta_imagen_usuario }}" class="imgRedonda">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
								{{ Auth::user()->usuario }}
								</a>
								<div class="dropdown-menu">
									<form method="GET" action="/editar-perfil">
										<input type="hidden" name="_token" value="{{ csrf_token()}}">
										<input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
										<input class="dropdown-item" type="submit" role="button" name="Actualizar Perfil" value="Actualizar Perfil">
									</form>
									<!--a href="/editar-perfil" class="dropdown-item">Actualizar Perfil</a-->
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
								    	Logout
								  	</a>
								  	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item">
								    	{{ csrf_field() }}
								  	</form>
								</div>
							</li>
				 		@else
				 			<li class="nav-item">
								<a class="nav-link" href="{{ url('/') }}">Inicio
									<span class="sr-only">(current)</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('/mis-reservas') }}">Mis Reservas</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" href="{{ url('/contactanos') }}">Contactanos</a>
							</li>		  -->
							<li class="btn-group dropdown">
								<img src="/images/usuarios/{{ Auth::user()->ruta_imagen_usuario}}" class="imgRedonda">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
								{{ Auth::user()->usuario }}
								</a>
								<div class="dropdown-menu">
									<form method="GET" action="/editar-perfil">
										<input type="hidden" name="_token" value="{{ csrf_token()}}">
										<input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
										<input class="dropdown-item" type="submit" role="button" name="Actualizar Perfil" value="Actualizar Perfil">
									</form>
									<!--a href="/editar-perfil" class="dropdown-item">Actualizar Perfil</a-->
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
								    	Logout
								  	</a>
								  	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item">
								    	{{ csrf_field() }}
								  	</form>
								</div>
							</li>
				 		@endif
				 	@endif
				</ul>
			</div>
		</div>
 	</nav>
</header>

<br>

@yield('content')
	
</section>
<footer class="card-footer bg-dark">
	<div class="container" >
		<div class="card-deck">
		  <div class="card">
		    <img class="card-img-top" src="/images/pagina/contactanos.png" alt="Contactanos">
		    <div class="card-body bg-dark">
		      <h5 class="card-title text-white">Contactanos</h5>
		      <p class="card-text text-white">Si deseas contactar con los creadores puedes acceder a los siguientes numeros: 
					-123456789 <br>-123456789 <br>Para poder compartir ideas, hablar sobre puntos especificos, buscar trabajo, etc. Contactenos a este correo: <br> -gerardocachera@gmail.com</p>
		    </div>
		  </div>
		  <div class="card">
		    <img class="card-img-top" src="/images/pagina/equipo.png" alt="Equipo">
		    <div class="card-body bg-dark">
		      <h5 class="card-title text-white">Nosotros</h5>
		      <p class="card-text text-white">Nosotros somos un grupo emprendedor destinos a la creacion de paginas web asi como elaboracion de Apps,
					teniendo en cuenta las operaciones entre ellos. Venimos de una promocion de exelencia del Instituto Superior Tecsup-Arequipa-Peru.
					Siempre con las mentes abiertas hacia nuevas ideas y aportes hacia los trabajos realizados.</p>
		    </div>
		  </div>
		  <div class="card">
		    <img class="card-img-top" src="/images/pagina/Pregunta.jfif" alt="Dudas">
		    <div class="card-body bg-dark">
		      <h5 class="card-title text-white">No solo te quedes aca!</h5>
		      <p class="card-text text-white">SacaPichangas tambien puede estar en tu celular:<br>-Android<br>-iOS<br>-Huawei<br>Buscanos 
					en tu App Store o tu Play Store como SacaPichangas.<br>Listo para la Pichanga?</p>
		    </div>
		  </div>
		</div>
	</div>

	<br>
	<div class="container">
		<h2 class="ftco-heading-2 text-right text-white">
			Copyright &copy; SacaPichangas 2019
		</h2>
	</div>
</footer>

      <!--===============================================================================================-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <!--===============================================================================================-->
        <script src="perso/vendor/animsition/js/animsition.min.js"></script>
      <!--===============================================================================================-->
        <script src="perso/vendor/bootstrap/js/popper.js"></script>
        <script src="perso/vendor/bootstrap/js/bootstrap.min.js"></script>
      <!--===============================================================================================-->
        <script src="perso/vendor/select2/select2.min.js"></script>
      <!--===============================================================================================-->
        <script src="perso/vendor/daterangepicker/moment.min.js"></script>
        <script src="perso/vendor/daterangepicker/daterangepicker.js"></script>
      <!--===============================================================================================-->
        <script src="./public/perso/vendor/countdowntime/countdowntime.js"></script>
      <!--===============================================================================================-->
      	<script src="perso/js/main.js"></script>
</body>
</html>
