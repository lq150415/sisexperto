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
        <a class="btn btn-raised btn-success" title="Diagnostico" onclick="llegada('0','0','0','{{$paciente->id}}','0')" data-toggle="modal" data-target="#miModal2"><i class="material-icons" >create</i> Comenzar diagnostico</a>
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
    function llegada(var1,var2,var3, var4,var5){
      var parametros = {
                "preg" : var1,
                "diag" : var2,
                "res" : var3,
                "pac" : var4,
                "prev": var5,
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
                    switch (data.preg) {
                      case 100:
                      case 101:
                      case 102:
                      case 103:
                      case 104:
                      case 105:
                      case 106:
                      case 107:
                      case 108:
                      case 109:
                      case 110:
                      case 111:
                      case 112:
                      case 113:
                        var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5"> Usted padece de : '+data.enfermedad+'</font></div><div> <img src="{{url('images/doctor.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" href="{{url('/diagnostico/detalles/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary" ><i class="material-icons">receipt </i> VER DETALLES </a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-danger"><i class="material-icons">close</i>Cancelar</a></div>';
                        dhtml+='</table>';
                      break;
                      case 1:
                        var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                        dhtml+='</table>';
                      break;
                      case 2:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-thermometer-0"></i> 36-37,5˚C </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-thermometer-1"></i> 37.5-38˚C</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-thermometer-2"></i> 38,5 ˚C </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-thermometer-full"></i> 39 ˚C</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 3:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ausencia de dolor </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Dolor leve</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Dolor fuerte</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Dolor muy fuerte o insoportable</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 4:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Cansancio al subir las gradas</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Cansancio al cambiarse la ropa</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cansancio al peinarse</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 5:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Duración de dias</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Duracion semanas</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 6:
                        var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                        dhtml+='</table>';
                      break;
                      case 7:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Globulos rojos distribuidos en la cabeza</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Glóbulos rojos distribuidos desde la cabeza hasta el torso</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Glóbulos distribuidos en todo el cuerpo</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 8:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 9:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i>A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el bazo es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 10:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ausencia de dolor </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Dolor leve</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Dolor fuerte</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Dolor muy fuerte o insoportable</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 11:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el hígado es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 12:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 13:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 14:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ausencia de dolor </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Dolor leve</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Dolor fuerte</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Dolor muy fuerte o insoportable</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 15:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Rechazo al recibir alimento y fatiga</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 16:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Eritema conjuntiva</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Eritema conjuntiva</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Eritema inflamatoria con presencia de pus</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 17:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 18:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 19:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 20:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el bazo es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 21:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el higado es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 22:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Ganglios inflamados en un solo lugar(Cuello, axilas o entrepiernas)</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Ganglios linfáticos inflamados en más de un lugar (Cuello, axilas o entrepiernas)</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 23:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Rechazo al recibir alimento y fatiga</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 24:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 25:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+' Es necesario realizar exámenes complementarios para confirmar la hemorragia interna. El examen requerido es la ecografía: ¿Tiene el examen de ecografía?</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 26:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ausencia de dolor </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Dolor leve</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Dolor fuerte</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Dolor muy fuerte o insoportable</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 27:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      case 28:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 29:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el higado es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 30:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Debajo del reborde costal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> A la altura del reborde costal</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando el bazo es palpable en la cavidad abdominal</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 31:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Rechazo al recibir alimento y fatiga</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 32:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+' </font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 33:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Inflamación de la mucosa nasal menos del 30%</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Inflamación de la mucosa nasal más del 50 %</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Inflamación de la mucosa nasal más del 90%</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 34:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Sin síntomas en relación a la actividad física actual </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Inflamación de la mucosa nasal menos del 30%Sin síntomas durante el reposo. Síntomas con grandes esfuerzos, leve limitación a actividad física</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Limitación marcada para actividad física pero sin molestias durante el reposo</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Existen síntomas permanentes en reposo que se intensifican con esfuerzos menores</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 35:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+' </font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 36:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','25','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="fa fa-smile-o"></i> Cuando ingiere alimentos solidos(La papa)</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Cuando ingiere alimentos semisólidos (La mermelada)</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Cuando ingiere líquidos(Agua o jugos)</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 37:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+' </font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 38:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+' </font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 39:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="fa fa-smile-o"></i> Ninguna de las opciones </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','75','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="fa fa-meh-o"></i> Duración de dias</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="fa fa-frown-o"></i> Duracion semanas</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      case 40:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'Es necesario realizar exámenes complementarios para confirmar el aumento de tamaño del esófago. Los exámenes requeridos son:•	Rayos X contrastado•	Tomografía•	Endoscopia¿Tiene los exámenes mencionados anteriormente?</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class="modal-footer"><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success" ><i class="material-icons"> thumb_up </i> SI&nbsp;&nbsp; </a><br><a type="button"                         onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger" ><i class="material-icons">thumb_down</i> NO</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                      break;
                      default:
                      var dhtml='<div class="row"><div class="col-md-4" style="margin-top:20%;float:right; height:50px; width:350px;"><font size="5">'+data.pregunta+'</font></div><div> <img src="{{url('images/movimiento.gif')}}" style="height:230px; width:190px; float:left; margin-left:7%;"/></div></div><div class=""><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-success col-lg-12" ><i class="material-icons"> thumb_up </i> Normal </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-info col-lg-12" ><i class="material-icons"> thumb_up </i> Leve</a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','100','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-warning col-lg-12" ><i class="material-icons"> thumb_up </i> Moderado </a><br><a type="button" onclick='+'"llegada('+"'"+data.preg+"','"+data.dia+"','0','"+data.pac+"','"+data.prev+"'"+');"'+' class="btn btn-raised btn-danger col-lg-12" ><i class="material-icons">thumb_down</i> Grave</a></div><div><a href="{{url('/diagnosticos/cancelar/')}}'+'/'+data.dia+'" class="btn btn-raised btn-primary"><i class="material-icons">close</i>Cancelar</a></div>';
                      dhtml+='</table>';
                    }
                    $("#resultado").html(dhtml);
                }
        });
    }
  </script>
@endsection
