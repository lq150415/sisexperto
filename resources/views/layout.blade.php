<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('images/medico.png')}}" />
    <link rel="icon" type="image/png" href="{{url('images/medico.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('titulo')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    {!! Html::style('assets/css/bootstrap.min.css')!!}
    <!--  Material Dashboard CSS    -->
    {!! Html::style('assets/css/material-dashboard.css?v=1.2.0')!!}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {!! Html::style('assets/css/demo.css')!!}
    <!--     Fonts and icons     -->
    {!! Html::style('fa/css/font-awesome.min.css')!!}
    {!! Html::style('roboto-and-material-icons-fonts-master/css/roboto.min.css')!!}
    {!! Html::style('roboto-and-material-icons-fonts-master/css/material-icons.min.css')!!}
    {!! Html::style('dynatable/jquery.dynatable.css') !!}
    {!! Html::style('css/alert.css') !!}

    @yield('css')
</head>
<body style="background-image: url('{{ url('images/fondo.png') }}'); background-size: 210px;">
    <div id="imgLOAD" style="text-align:center; position:absolute; cursor: wait;">
  			<img src="{{ url('images/cargando.gif') }}" width="300vw" /><br>
        <b>Cargando...</b>
  		</div>
  		<!-- Fin del div de animacion !-->
  		@php
  			if(Session::has('mensaje')):
  		@endphp
  		<div class="alert alert-primary alerta" id="good" style=" border-radius: 7px; ">
  			<button type="button" class="close" data-dismiss="alert">&times; </button>
  			<strong>Exito! </strong>
  			{{ '  '.Session::get('mensaje')}}
  		</div>
  		@php
  			endif;
  			if(Session::has('mensaje2')):
  		@endphp
  		<div class="alert alert-danger alerta" id="wrong" style=" border-radius: 7px; ">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Alerta! </strong>
  			{{ Session::get('mensaje2')}}
  		</div>
  		@php
  			endif;
  		@endphp
    <div id="page" class="wrapper">
        <div class="sidebar" data-color="blue" data-image="{{url('assets/img/sidebar-5.jpg')}}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="#" class="simple-text">
                    SISTEMA EXPERTO
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li @yield('inicio')>
                        <a href="{{route('index')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Pagina principal</p>
                        </a>
                    </li>
                    <li @yield('paciente')>
                        <a href="{{route('paciente.index')}}">
                            <i class="material-icons">person</i>
                            <p>Pacientes</p>
                        </a>
                    </li>
                    <li @yield('diagnostico')>
                        <a href="{{route('diagnostico.index')}}">
                            <i class="material-icons">content_paste</i>
                            <p>Diagnosticos</p>
                        </a>
                    </li>
                    <li @yield('historial')>
                        <a href="{{route('historial.index')}}">
                            <i class="material-icons">library_books</i>
                            <p>Historial</p>
                        </a>
                    </li>
                    <li @yield('reportes')>
                        <a href="{{route('reporte.index')}}">
                            <i class="material-icons">import_contacts</i>
                            <p>Reportes</p>
                        </a>
                    </li>
                    <li @yield('reservas')>
                        <a href="{{route('reservas.index')}}">
                            <i class="material-icons">alarm</i>
                            <p>Reservas</p>
                        </a>
                    </li>

                    <li class="active-pro">
                        <a href="{{url('logout')}}">
                            <i class="material-icons">highlight_off</i>
                            <p>CERRAR SESION</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><b> SISTEMA EXPERTO DE DIAGNOSTICO DE ENFERMEDADES TROPICALES </b></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" title="Notificaciones" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">
                                      @php
                                        $reservas= \experto\Reserva::join('paciente','paciente.id','=','reserva.id_rpac')->whereRaw('DATE(fec_res)=CURRENT_DATE')->get();
                                        echo \experto\Reserva::whereRaw('DATE(fec_res)=CURRENT_DATE')->count();
                                      @endphp
                                    </span>
                                    <p class="hidden-lg hidden-md">Notificaciones</p>
                                </a>
                                <ul class="dropdown-menu">
                                  @if (count($reservas)>0)
                                    @foreach ($reservas as $reserva)
                                      <li>
                                          <a href="{{url('diagnostico/'.$reserva->id_rpac)}}">Reserva a horas {{$reserva->hor_res}} del paciente {{$reserva->nom_pac.' '.$reserva->pat_pac.' '.$reserva->mat_pac}}</a>
                                      </li>
                                    @endforeach
                                  @else
                                    <li>
                                      <a>No tiene notificaciones nuevas</a>
                                    </li>
                                  @endif

                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" title="Perfil" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Perfil de usuario</p>
                                </a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Buscar ...">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-info btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="content">
              @yield('contenido')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Inicio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Usuarios
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Pacientes
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Historial
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">Unifranz</a>, Ingenieria en sistemas 2017
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
{!! Html::script('assets/js/jquery-3.2.1.min.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
{!! Html::script('assets/js/material.min.js') !!}
{!! Html::script('dynatable/jquery.dynatable.js') !!}
<!--  Charts Plugin -->
{!! Html::script('assets/js/chartist.min.js') !!}
<!--  Dynamic Elements plugin -->
{!! Html::script('assets/js/arrive.min.js') !!}
<!--  PerfectScrollbar Library -->
{!! Html::script('assets/js/perfect-scrollbar.jquery.min.js') !!}
<!--  Notifications Plugin    -->
{!! Html::script('assets/js/bootstrap-notify.js') !!}
<!--  Google Maps Plugin
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!-- Material Dashboard javascript methods -->
{!! Html::script('assets/js/material-dashboard.js?v=1.2.0') !!}
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
{!! Html::script('assets/js/demo.js') !!}


@yield('script')
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
			function launchFullScreen(element) {
  			if(element.requestFullScreen) {
    			element.requestFullScreen();
  			} else if(element.mozRequestFullScreen) {
    			element.mozRequestFullScreen();
  			} else if(element.webkitRequestFullScreen) {
    			element.webkitRequestFullScreen();
  			}
			}
		</script>
</html>
