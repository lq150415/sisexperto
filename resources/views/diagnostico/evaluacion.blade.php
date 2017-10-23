@extends('../layout')
@section('titulo')
Diagnostico de enfermedad tropical  - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('diagnostico')
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
        <span><b>Codigo: </b>{{$paciente->cod_pac}}</span><br>
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
        <br>
        <a class="btn btn-raised btn-success" title="Diagnostico" onclick="llegada('0','0','0','{{$paciente->id}}')" data-toggle="modal" data-target="#miModal2"><i class="material-icons" >create</i> Comenzar diagnostico</a>
      </div>

  </div>
</div>

<div class="modal fade" id="miModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Diagnostico de enfermedad tropical</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <legend>Paciente -  {{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac}}</legend>
          <div class="row form-group" id="resultado">

          </div>
        </fieldset>
      </div>

    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection
@section('script')
  <script type="text/javascript">
    $(function() {
      var pacientes ={!! json_encode($paciente->toArray()) !!};
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
      pacientes[i].boton='<a title="Historial" class="btn btn-warning btn-raised active" href="historial/pacientes/'+pacientes[i].id+'"><i class="material-icons">history</i></a>';
    }

      $('#pacientes').dynatable({
          dataset:{records:pacientes},
      });
      $('#laboratorios').dynatable({
          dataset:{records:pacientes},
      });
      $('#tratamientos').dynatable({
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

    <script type="text/javascript">
    function llegada(var1,var2,var3, var4){
      var parametros = {
                "preg" : var1,
                "diag" : var2,
                "res" : var3,
                "pac" : var4,
                "_token": "{{ csrf_token() }}"
        };
        console.log(parametros);
      $.ajax({
                data:  parametros,
                url:   'getDiagnostico',
                type:  'post',
                beforeSend: function () {
                        document.getElementById('resultado').innerHTML='<center><img src="{{url('images/cargando2.gif')}}" alt="cargando" /><br />Cargando .....</center>'
                },
                success:  function (data) {

                    var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar')}}" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';

                    dhtml+='</table>';
                    $("#resultado").html(dhtml);
                }
        });
    }
  </script>
@endsection
