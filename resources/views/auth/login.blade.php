
<!DOCTYPE html>
<html>
<head>
<title>Bienvenido - Iniciar Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Custom Theme files -->
{!! Html::style('css/style.css')!!}
{!! Html::style('css/app.css')!!}
</head>
<body>
	<!-- main -->
	<div class="main-agileinfo slider ">
		<div class="items-group">
			<div class="item agileits-w3layouts">
				<div class="block text main-agileits">
					<span class="circleLight"></span>
					<!-- login form -->
					<div class="login-form loginw3-agile">
						<div class="agile-row">
							<h1>Bienvenido</h1>
							<div class="login-agileits-top">
                <form class="form-horizontal" method="POST" action="{{route('login')}}">
									<p>Nombre de usuario </p>
									<input type="text" class="name" name="nom_user" required=""/>
									<p>Contraseña</p>
									<input type="password" class="password" name="password" required=""/>
                  <br><br>
									<input type="submit" value="Ingresar al sistema">
                  <br><br>
								</form>
                <a href="{{route('register')}}" class="btn areg" style="width:100%">Registrarse</a>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- //main -->
</body>
</html>
