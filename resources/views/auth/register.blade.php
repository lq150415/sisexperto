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
<body style="background: url(../images/bg2.jpg)repeat">
	<!-- main -->
	<div class="main-agileinfo slider ">
		<div class="items-group">
			<div class="item agileits-w3layouts">
				<div class="block block2 text main-agileits">
					<span class="circleLight"></span>
					<!-- login form -->
					<div class="login-form loginw3-agile">
						<div class="agile-row">
							<h1>Formulario de registro </h1>
							<div class="form-group">
                <form class="form-horizontal" method="POST" action="{{ route('register.user') }}">
                    {{ csrf_field() }}
                    <div class="">
                        <p>Nombre:</p>
                        <div class="">
                            <input id="name" type="text" class="" name="nom_user" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="">
                        <p>Apellido paterno</p>
                        <div class="">
                            <input id="name" type="text" class="" name="pat_user" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="">
                        <p>Apellido Materno</p>
                        <div class="">
                            <input id="name" type="text" class="" name="mat_user" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="">
                        <p >Numero de carnet de identidad</p>
                        <div class="">
                            <input id="email" type="text" class="" name="ci_user" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="">
                        <p >Fecha de nacimiento</p>
                        <div class="">
                            <input id="date" type="date" class="" name="fec_user" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="">
                      <p >Nombre de usuario (Nick)</p>
                      <div class="">
                        <input id="email" type="text" class="" name="nick_user" value="{{ old('email') }}" required>
                      </div>
                    </div>
                    <div class="">
                        <p>Contraseña</p>
                        <div class="">
                            <input id="password" type="password" class="" name="password" required>
                        </div>
                    </div>
                    <div class="">
                        <p>Repetir contraseña</p>
                        <div class="">
                            <input id="password-confirm" type="password" class="" name="password_confirmation" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="">
                        <div class="">
                            <input type="submit" value="Registrar">
                        </div>
                    </div>
                </form>
                <br>
                <a href="{{route('login')}}" class="btn areg" style="width:100%">Iniciar sesion</a>
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
