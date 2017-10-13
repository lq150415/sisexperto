@extends('../layout')
@section('titulo')
  Reservas - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('reservas')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header" data-background-color="blue">
  		<h4 class="title">Lista de reservas</h4>
  	  </div>
      <div class="form-group row">
        <button type="button"  data-toggle="modal" data-target="#miModal" class="btn btn-raised btn-primary" name="button"><i class="material-icons">edit</i> Registrar nuevo paciente</button>
      </div>
      <div class="card-content table-responsive table-full-width">
        <fieldset>
          <form class="" action="{{route('reservas.store')}}" method="post">
            {{ csrf_field() }}
          <legend class="label label-info" style="font-size:14px">Registro de reserva</legend>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="">Paciente: </label>
            </div>
            <div class="col-md-8">
          <select class="form-control" name="id_rpac" required>
            <option value="">SELECCIONE</option>
            @foreach ($pacientes as $paciente)
              <option value="{{$paciente->id}}">{{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac}}</option>
            @endforeach
          </select>
          </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="">Fecha: </label>
            </div>
            <div class="col-md-8">
              <input type="date" name="fec_res" class="form-control" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="">Hora: </label>
            </div>
            <div class="col-md-8">
              <input type="time" name="hor_res" class="form-control" value="" required>
            </div>
          </div>
        <div class="modal-footer row">
          <button type="submit" class="btn btn-success" style="margin:0" name="button">Registrar</button>
          <button type="button" class="btn btn-danger" style="margin:0" name="button">Limpiar campos</button>
        </div>
        </form>
        </fieldset>
        <fieldset>
          <legend class="label label-primary" style="font-size:14px">Lista de reservas</legend>
		<table class="table table-hover" id="reservas">
      <thead>
        <th data-dynatable-column="cod_res">Codigo</th>
        <th data-dynatable-column="fec_res">Fecha</th>
        <th data-dynatable-column="hor_res">Hora</th>
        <th data-dynatable-column="paciente">Paciente</th>
        <th data-dynatable-column="medico">Medico</th>
        <th data-dynatable-column="boton">Acciones</th>
      </thead>
      <tbody>

      </tbody>
  	</table>
  </fieldset>

	</div>
  </div>
</div>
<!-- Modal !--><!-- Modal !-->

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title">Registro de paciente </h4>
    </div>
    <div class="modal-body">
      {!! Form::open(['route' => 'reservapaciente.store']) !!}
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">CI:</label>
      <div class="col-md-8" >
        <input type="text" name="ci_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Nombre:</label>
      <div class="col-md-8" >
        <input type="text" name="nom_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Apellido paterno:</label>
      <div class="col-md-8" >
        <input type="text" name="pat_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Apellido materno:</label>
      <div class="col-md-8" >
        <input type="text" name="mat_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Fecha de nacimiento:</label>
      <div class="col-md-8" >
        <input type="date" name="fec_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Genero:</label>
      <div class="col-md-8" >
        <select class="form-control" name="gen_pac">
          <option value="">ELIJA UNA OPCION</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Telefono:</label>
      <div class="col-md-8">
        <input type="number" name="tel_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Ocupacion:</label>
      <div class="col-md-8">
        <input type="text" name="ocu_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Direccion:</label>
      <div class="col-md-8">
        <input type="text" name="dir_pac" class="form-control" required>
      </div></div>
    </div><br><br>
   <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons">close</i>Cerrar</button>
      <button type="submit" class="btn btn-primary"><i class="material-icons">check</i>Guardar</button>
    </div>
  </div>
  {!! Form::close() !!}
</div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title">Modificar reserva </h4>
    </div>
    <div class="modal-body">
      {!! Form::open(['route' => 'reserva.actualizar']) !!}
      <div class="form-group has-danger">
        <input type="hidden" name="mid" id="mid" value="">
        {{csrf_field()}}
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Fecha de reserva:</label>
      <div class="col-md-8" >
        <input type="date" name="mfec_res" id="mfec_res" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Hora de reserva:</label>
      <div class="col-md-8" >
        <input type="time" name="mhor_res" id="mhor_res" class="form-control" required>
      </div></div>
    </div><br><br>
   <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons">close</i>Cerrar</button>
      <button type="submit" class="btn btn-primary"><i class="material-icons">check</i>Actualizar</button>
    </div>
  </div>
  {!! Form::close() !!}
</div>
</div>
<!-- Modal -->
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">ELIMINAR RESERVA</h4>
                          </div>
                          <div class="modal-body">
                            <form class="" action="{{route('reserva.eliminar')}}" method="post">
                              {{csrf_field()}}
                              <input type="hidden" class="" id="eid" name="eid" value="">
                            <p>Esta seguro de eliminar al paciente?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">ELIMINAR</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                        </form>

                      </div>
                    </div>


@endsection
@section('script')
  <script type="text/javascript">
    $(function() {
      var reservas ={!! json_encode($reservas->toArray()) !!};
      for (var i = 0; i < reservas.length; i++) {
        var id=reservas[i].id;
        var nom=reservas[i].nom_pac;
        var pat=reservas[i].pat_pac;
        var mat=reservas[i].mat_pac;
        var unom=reservas[i].nom_user;
        var upat=reservas[i].pat_user;
        var umat=reservas[i].mat_user;
        var fec=reservas[i].fec_res;
        var hor=reservas[i].hor_res;
        var b="'"+id+"','"+fec+"','"+hor+"'";
      reservas[i].boton='<a onclick="javascript:modres('+b+');" class="btn btn-warning btn-raised active" data-toggle="modal" data-target="#myModal2" title="Modificar paciente" color: #fff;"><i class="material-icons">mode_edit</i></a><a onclick="javascript:elires('+id+');" class="btn btn-warning btn-raised active" data-toggle="modal" title="Eliminar paciente" data-target="#myModal3" style="background-color:#ed1414; color: #fff;" ><i class="material-icons">delete</i></a>';
      reservas[i].paciente=nom+' '+pat+' '+mat;
      reservas[i].medico=unom+' '+upat+' '+umat;
    }

      $('#reservas').dynatable({
          dataset:{records:reservas},
      });
    });
  </script>
  <script type="text/javascript">
    function elires(id){
        $('#eid').val(id);
      }
    function modres(id,fec,hor){
            $('#mid').val(id);
            $('#mfec_res').val(fec);
            $('#mhor_res').val(hor);
    }
    </script>
@endsection
