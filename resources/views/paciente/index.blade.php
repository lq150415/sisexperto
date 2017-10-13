@extends('../layout')
@section('titulo')
  Pacientes - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('paciente')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header" data-background-color="blue">
  		<h4 class="title">Lista de pacientes</h4>
  	  </div>
      <div class="form-group row">
        <button type="button"  data-toggle="modal" data-target="#miModal" class="btn btn-raised btn-primary" name="button"><i class="material-icons">edit</i> Registrar nuevo</button>
      </div>
      <div class="card-content table-responsive table-full-width">
		<table class="table table-hover" id="pacientes">
      <thead>
        <th data-dynatable-column="cod_pac">Codigo</th>
        <th data-dynatable-column="ci_pac">CI</th>
        <th data-dynatable-column="nom_pac">Nombre</th>
        <th data-dynatable-column="pat_pac">Paterno</th>
        <th data-dynatable-column="mat_pac">Materno</th>
        <th data-dynatable-column="fec_pac">Fecha de nacimiento</th>
        <th data-dynatable-column="gen_pac">Genero</th>
        <th data-dynatable-column="boton">Acciones</th>
      </thead>
      <tbody>

      </tbody>
  	</table>

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
      {!! Form::open(['route' => 'paciente.store']) !!}
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
      <h4 class="modal-title">Modificar paciente </h4>
    </div>
    <div class="modal-body">
      {!! Form::open(['route' => 'paciente.actualizar']) !!}
      <div class="form-group has-danger">
        <input type="hidden" name="mid" id="mid" value="">
        {{csrf_field()}}
      <label class="col-md-4 control-label">CI:</label>
      <div class="col-md-8" >
        <input type="text" name="mci_pac" id="mci_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Nombre:</label>
      <div class="col-md-8" >
        <input type="text" name="mnom_pac" id="mnom_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Apellido paterno:</label>
      <div class="col-md-8" >
        <input type="text" name="mpat_pac" id="mpat_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Apellido materno:</label>
      <div class="col-md-8" >
        <input type="text" name="mmat_pac" id="mmat_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Fecha de nacimiento:</label>
      <div class="col-md-8" >
        <input type="date" name="mfec_pac" id="mfec_pac" class="form-control" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Genero:</label>
      <div class="col-md-8" >
        <select class="form-control" name="mgen_pac" id="mgen_pac">
          <option value="">ELIJA UNA OPCION</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Telefono:</label>
      <div class="col-md-8">
        <input type="number" name="mtel_pac" class="form-control" id="mtel_pac" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Ocupacion:</label>
      <div class="col-md-8">
        <input type="text" name="mocu_pac" class="form-control" id="mocu_pac" required>
      </div></div>
      <div class="form-group has-danger">
        <label class="col-md-4 control-label">Direccion:</label>
      <div class="col-md-8">
        <input type="text" id="mdir_pac" name="mdir_pac" class="form-control" required>
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
                            <h4 class="modal-title">ELIMINAR PACIENTE</h4>
                          </div>
                          <div class="modal-body">
                            <form class="" action="{{route('paciente.eliminar')}}" method="post">
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
      var pacientes ={!! json_encode($pacientes->toArray()) !!};
      for (var i = 0; i < pacientes.length; i++) {
        var id=pacientes[i].id;
        var nom=pacientes[i].nom_pac;
        var pat=pacientes[i].pat_pac;
        var mat=pacientes[i].mat_pac;
        var fec=pacientes[i].fec_pac;
        var ci=pacientes[i].ci_pac;
        var gen=pacientes[i].gen_pac;
        var ocu=pacientes[i].ocu_pac;
        var tel=pacientes[i].tel_pac;
        var dir=pacientes[i].dir_pac;
        var b="'"+id+"','"+nom+"','"+pat+"','"+mat+"','"+fec+"','"+ci+"','"+gen+"','"+ocu+"','"+tel+"','"+dir+"'";
      pacientes[i].boton='<a onclick="javascript:modpac('+b+');" class="btn btn-warning btn-raised active" data-toggle="modal" data-target="#myModal2" title="Modificar paciente" color: #fff;"><i class="material-icons">mode_edit</i></a><a onclick="javascript:elipac('+id+');" class="btn btn-warning btn-raised active" data-toggle="modal" title="Eliminar paciente" data-target="#myModal3" style="background-color:#ed1414; color: #fff;" ><i class="material-icons">delete</i></a><a title="Realizar consulta" class="btn btn-primary btn-raised active" href="diagnostico/'+pacientes[i].id+'"><i class="material-icons">content_paste</i></a>';
    }

      $('#pacientes').dynatable({
          dataset:{records:pacientes},
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
