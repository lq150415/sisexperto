@extends('../layout')
@section('titulo')
Historial de pacientes  - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('historial')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header" data-background-color="purple">
  		<h4 class="title">Paciente - {{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac}}</h4>
    </div><br>
      <div class="well">
        <span><b>Numero de carnet de identidad: </b>{{$paciente->ci_pac}}</span><br>
        <span><b>Codigo de paciente: </b>{{$paciente->cod_pac}}</span><br>
        <span><b>Paciente: </b>{{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac}}</span><br>
        <span><b>Edad: </b>
          @php
              $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('Y');
              $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('m');
              $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('d');
              $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
              echo $date;
          @endphp
        </span><br>
        <span><b>Genero: </b>{{$paciente->gen_pac}}</span><br>
        <span><b>Telefono: </b>{{$paciente->tel_pac}}</span><br>
        <span><b>Ocupacion: </b>{{$paciente->ocu_pac}}</span><br>
        <span><b>Direccion: </b>{{$paciente->dir_pac}}</span><br>
      </div>
      <div class="card card-nav-tabs">
      	<div class="card-header" data-background-color="purple">
      		<div class="nav-tabs-navigation">
      			<div class="nav-tabs-wrapper">
      				<span class="nav-tabs-title">Listado:</span>
      				<ul class="nav nav-tabs" data-tabs="tabs">
      					<li class="active">
      						<a href="#profile" data-toggle="tab">
      							<i class="material-icons">local_hospital</i>
                    Diagnosticos
                <div class="ripple-container"></div></a>
      					</li>
      					<li class="">
      						<a href="#messages" data-toggle="tab">
      							<i class="fa fa-flask" aria-hidden="true"></i>
      							Laboratorios
      						<div class="ripple-container"></div></a>
      					</li>
      					<li class="">
      						<a href="#settings" data-toggle="tab">
      							<i class="fa fa-thermometer-full" aria-hidden="true"></i>
      							Tratamientos
      						<div class="ripple-container"></div></a>
      					</li>
      				</ul>
      			</div>
      		</div>
      	</div>

      	<div class="card-content">
      		<div class="tab-content">
      			<div class="tab-pane active" id="profile">
              <fieldset>
                <legend>Diagnosticos</legend>
              <div class="card-content table-responsive table-full-width">
            <table class="table table-hover" id="diagnosticos">
              <thead>
                <th data-dynatable-column="cod_dia">Codigo de diagnostico</th>
                <th data-dynatable-column="fec_dia">Fecha</th>
                <th data-dynatable-column="hor_dia">Hora</th>
                <th data-dynatable-column="medico">ID medico</th>
                <th data-dynatable-column="dia_dia">Diagnostico</th>
                <th data-dynatable-column="button">Ver</th>
              </thead>
              <tbody>
              </tbody>
            </table>
              </div>
            </fieldset>
      			</div>
      			<div class="tab-pane" id="messages">
              <fieldset>
                <legend>Laboratorios</legend>
              <div class="card-content table-responsive table-full-width">
            <table class="table table-hover" id="laboratorios">
              <thead>
                <th data-dynatable-column="cod_pac">Codigo de paciente</th>
                <th data-dynatable-column="ci_pac">C.I.</th>
                <th data-dynatable-column="nom_pac">Nombre paciente</th>
                <th data-dynatable-column="pat_pac">Paterno</th>
                <th data-dynatable-column="mat_pac">Materno</th>
                <th data-dynatable-column="edad">Edad</th>
                <th data-dynatable-column="boton">Ver historial</th>
              </thead>
              <tbody>
              </tbody>
            </table>
              </div>
            </fieldset>
      			</div>
      			<div class="tab-pane" id="settings">
              <fieldset>
                <legend>Tratamientos</legend>
              <div class="card-content table-responsive table-full-width">
            <table class="table table-hover" id="tratamientos">
              <thead>
                <th data-dynatable-column="cod_pac">Codigo de paciente</th>
                <th data-dynatable-column="ci_pac">C.I.</th>
                <th data-dynatable-column="nom_pac">Nombre paciente</th>
                <th data-dynatable-column="pat_pac">Paterno</th>
                <th data-dynatable-column="mat_pac">Materno</th>
                <th data-dynatable-column="edad">Edad</th>
                <th data-dynatable-column="boton">Ver historial</th>
              </thead>
              <tbody>
              </tbody>
            </table>
              </div>
            </fieldset>
      			</div>
      		</div>
      	</div>

      </div>


  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(function() {
      var diagnosticos ={!! json_encode($diagnosticos->toArray()) !!};
      for (var i = 0; i < diagnosticos.length; i++) {
      diagnosticos[i].medico=diagnosticos[i].nom_user+' '+diagnosticos[i].pat_user+' '+diagnosticos[i].mat_user;
      diagnosticos[i].button='<a href="{{url('diagnostico/detalles/')}}'+'/'+diagnosticos[i].id+'" class="btn btn-primary"><i class="material-icons">view_module</i> DETALLES</a>';
    }
      $('#diagnosticos').dynatable({
          dataset:{records:diagnosticos},
      });
      $('#laboratorios').dynatable({
          dataset:{},
      });
      $('#tratamientos').dynatable({
          dataset:{},
      });
    });
  </script>
  <script type="text/javascript">
    function elipac(id){
        $('#eid').val(id);
      }
    function modpac(id,nom,pat,mat,fec,ci,gen,ocu,tel,dir){
            $('#mid').val(id);
            $('#mnom_pac').val(nom);
            $('#mpat_pac').val(pat);
            $('#mmat_pac').val(mat);
            $('#mfec_pac').val(fec);
            $('#mci_pac').val(ci);
            $('#mocu_pac').val(ocu);
            $('#mtel_pac').val(tel);
            $('#mdir_pac').val(dir);
            $('#mgen_pac option[value='+gen+']').attr("selected", true);
    }
    </script>
@endsection
