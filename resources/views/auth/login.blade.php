
<!DOCTYPE html>
<html>
<head>
<title>Bienvenido - Iniciar Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Custom Theme files -->
{!! Html::style('css/style.css')!!}
{!! Html::style('css/alert.css')!!}
{!! Html::style('css/app.css')!!}
</head>
<body>
	<!-- Animacion de cargar pagina, usar en los modulos que son necesarios!-->
		<div id="imgLOAD" style="text-align:center; position:absolute; cursor: wait;">
			<img src="{{ url('images/cargando.gif') }}" /></br>
			<b>Cargando...</b>
		</div>
		<!-- Fin del div de animacion !-->
		@php
			if(Session::has('mensaje')):
		@endphp
		<div class="alert alert-success alerta" id="good" style=" border-radius: 7px; ">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>Exito! </strong>
			{{ Session::get('mensaje')}}
		</div>
		@php
			endif;
			if(Session::has('mensaje2')):
		@endphp
		<div class="alert alert-danger alerta" id="wrong" style=" border-radius: 7px; ">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>Alerta! </strong>
			{{ Session::get('mensaje2')}}
		</div>
		@php
			endif;
		@endphp

	<!-- main -->
	<div id="page" class="main-agileinfo slider ">
		<div class="items-group">
			<div class="item agileits-w3layouts">
				<div class="block text main-agileits">
					<span class="circleLight"></span>
					<!-- login form -->
					<div class="login-form loginw3-agile" style="z-index:1;">
						<div class="agile-row">
							<h1>Bienvenido</h1>
							<div class="login-agileits-top">
                <form class="form-horizontal" method="POST" action="{{url('login')}}">
									{{ csrf_field() }}
									<p>Nombre de usuario </p>
									<input type="text" class="name" name="nick_user" required=""/>
									<p>Contraseña</p>
									<input type="password" class="password" name="password" required=""/>
                  <br><br>
									<input type="submit" value="Ingresar al sistema">
                  <br><br>
								</form>
                <a href="{{url('register')}}" class="btn areg" style="width:100%">Registrarse</a>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- //main -->
</body>
{!! Html::script('js/app.js')!!}
<!--Recursos de la animacion de carga de pagina!-->
	<script type='text/javascript'>
			window.onload = detectarCarga;
			function detectarCarga(){
				document.getElementById("imgLOAD").style.display="none";
				document.getElementById("page").style.display="block";
			}
	</script>
<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function(){
				$(".alerta").fadeIn(2500); },0000);
			});
		$(document).ready(function() {
			setTimeout(function(){
				$(".alerta").fadeOut(2500); },5000);
			});
		</script>
</html>
