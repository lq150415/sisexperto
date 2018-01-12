@extends('../layout')
@section('titulo')
Resultados del diagnostico realizado  - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')
<style>
  .cardBox {
  float: left;
  margin: 1% 0 0 1%;
  perspective: 800px;
  transition: all 0.3s ease 0s;
  }

  .card2 {
    background: #fff;
    cursor: default;
    transform-style: preserve-3d;
    transition: transform 0.4s ease 0s;
    width: 100%;
    -webkit-animation: giro 1s 1;
    animation: giro 1s 1;
  }
  .front, .back {
    backface-visibility: hidden;
    box-sizing: border-box;
    display: block;
    height: 100%;
    width: 100%;
  }

  .back {
  transform: rotateY(180deg);
  }
  @media screen and (max-width: 767px) {
  .cardBox {
    margin-left: 2.8%;
    margin-top: 3%;
    width: 46%;
  }
  .card2 {
    height: 285px;
  }
  .cardBox:last-child {
    margin-bottom: 3%;
  }
}
@media screen and (max-width: 480px) {
  .cardBox {
    width: 94.5%;
    height: 290px;
  }
}
</style>
@endsection
@section('diagnostico')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header col-lg-7" data-background-color="purple">
  		    <h4 class="title">Paciente - {{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac.' '}} </h4>
      </div> <a class="btn btn-raised btn-warning col-lg-4" title="Tratamiento" target="_blank" href="{{url('diagnostico/reporte/'.$id)}}"><i class="material-icons" >create</i> Generar tratamiento (en base a la edad)</a><br>
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
      </div>
      <div class=" col-lg-5">
      <div class="card well ">
          <h5><b>USTED FUE DIAGNOSTICADO CON: </b><br><a title="Acerca de la enfermedad" href="#" data-toggle="modal" data-target="#miModal2"><h4 class="label label-danger" style="font-size:1.3vw;">{{$dia->dia_dia}}</h4></a></h5>
          <h5><b>EN UN PORCENTAJE DE: </b><br>
            @php
              $sum=0;
              foreach ($dias as $ds):
                $sum=$sum+$ds->res_sin;
              endforeach;
                $res=$sum/count($dias);
            @endphp
            <center>
              <h1>{{round($res,2).' %'}}</h1>
            </center>
          </h5>
          <h5><b>RECOMENDACIONES: </b><br><span class="success" >
            @if (0 <= $res && $res <=30)
              Se debe mantener la calma, el hecho de tener un porcentaje bajo no debe dar paso a descuidarse, este atento a nuevos sintomas ya que la enfermedad puede estar en una etapa temprana.
            @elseif (30<$res && $res<=50)
              Se recomienda realizar examenes complementarios para confirmar la gravedad de la enfermedad, se debe estar atento a posibles nuevo sintomas
            @elseif (50<$res && $res<=80)
              Se recomienda seguir un tratamiento y examenes complementarios para controlar la enfermedad
            @elseif (80<$res && $res<=100)
              La enfermedad es inminente, tome las medidas necesarias para controlarla, se recomienda la internacion del paciente
            @endif
          </h4></h5>

      </div>
      </div>
      <div class="row col-lg-6 col-lg-offset-1">
      <div class="card well ">
        <table class="table table-hover">
          <thead>
            <tr class="warning">
              <td><b>Sintoma</b></td>
              <td><b>Resultado</b></td>
            </tr>
          </thead>
          <tbody>
            @foreach ($dias as $dd)
              @php
                switch ($dd->id_ssin) {
                  case '1':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '2':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='39 °C';
                        break;
                      case '75':
                        $respuesta='38.5 °C';
                        break;
                      case '25':
                        $respuesta='37-38 °C';
                        break;
                      case '0':
                        $respuesta='36-37.5 °C';
                        break;
                    }
                    break;
                  case '3':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Dolor muy fuerte o insoportable';
                        break;
                      case '75':
                        $respuesta='Dolor fuerte';
                        break;
                      case '25':
                        $respuesta='Dolor leve';
                        break;
                      case '0':
                        $respuesta='Ausencia de dolor';
                        break;
                    }
                    break;
                  case '4':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cansancio al peinarse';
                        break;
                      case '75':
                        $respuesta='Cansancio al cambiarse de ropa';
                        break;
                      case '25':
                        $respuesta='Cansancio al subir las gradas';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '5':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Duración de semanas';
                        break;
                      case '75':
                        $respuesta='Duración de días';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '6':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '7':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Glóbulos distribuidos en todo el cuerpo';
                        break;
                      case '75':
                        $respuesta='Glóbulos rojos distribuidos desde la cabeza hasta el torso';
                        break;
                      case '25':
                        $respuesta='Glóbulos rojos distribuidos en la cabeza';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '8':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '9':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '10':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Dolor muy fuerte o insoportable';
                        break;
                      case '75':
                        $respuesta='Dolor fuerte';
                        break;
                      case '25':
                        $respuesta='Dolor leve';
                        break;
                      case '0':
                        $respuesta='Ausencia de dolor';
                        break;
                    }
                    break;
                  case '11':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '12':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '13':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '15':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='Rechazo al recibir alimento y fatiga';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '14':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Dolor muy fuerte o insoportable';
                        break;
                      case '75':
                        $respuesta='Dolor fuerte';
                        break;
                      case '25':
                        $respuesta='Dolor leve';
                        break;
                      case '0':
                        $respuesta='Ausencia de dolor';
                        break;
                    }
                    break;
                  case '16':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Eritema inflamatoria con presencia de pus';
                        break;
                      case '75':
                        $respuesta='Eritema inflamatoria';
                        break;
                      case '25':
                        $respuesta='Eritema conjuntiva';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '17':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '18':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '19':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '20':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '21':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '22':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Ganglios linfáticos inflamados en más de un lugar (Cuello, axilas o entrepiernas)';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='Ganglios inflamados en un solo lugar(Cuello, axilas o entrepiernas)';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '23':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='Rechazo al recibir alimento y fatiga';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '24':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '25':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '26':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Dolor muy fuerte o insoportable';
                        break;
                      case '75':
                        $respuesta='Dolor fuerte';
                        break;
                      case '25':
                        $respuesta='Dolor leve';
                        break;
                      case '0':
                        $respuesta='Ausencia de dolor';
                        break;
                    }
                    break;
                  case '27':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '28':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '29':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '30':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='A la altura del reborde costal';
                        break;
                      case '0':
                        $respuesta='Debajo del reborde costal';
                        break;
                    }
                    break;
                  case '31':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='Rechazo al recibir alimento y fatiga';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '32':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '33':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Inflamación de la mucosa nasal más del 90%';
                        break;
                      case '75':
                        $respuesta='Inflamación de la mucosa nasal más del 50 %';
                        break;
                      case '25':
                        $respuesta='Inflamación de la mucosa nasal menos del 30%';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '34':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Existen síntomas permanentes en reposo que se intensifican con esfuerzos menores';
                        break;
                      case '75':
                        $respuesta='Limitación marcada para actividad física pero sin molestias durante el reposo';
                        break;
                      case '25':
                        $respuesta='Sin síntomas durante el reposo. Síntomas con grandes esfuerzos, leve limitación a actividad física';
                        break;
                      case '0':
                        $respuesta='Sin síntomas en relación a la actividad física actual';
                        break;
                    }
                    break;
                  case '35':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '36':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Cuando ingiere líquidos(Agua o jugos)';
                        break;
                      case '75':
                        $respuesta='Cuando ingiere alimentos semisólidos(La mermelada)';
                        break;
                      case '25':
                        $respuesta='Cuando ingiere alimentos solidos(La papa)';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '37':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '38':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Si';
                        break;
                      case '75':
                        $respuesta='';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='No';
                        break;
                    }
                    break;
                  case '39':
                    switch ($dd->res_sin) {
                      case '100':
                        $respuesta='Duración de semanas';
                        break;
                      case '75':
                        $respuesta='Duración de días';
                        break;
                      case '25':
                        $respuesta='';
                        break;
                      case '0':
                        $respuesta='Ninguna de las opciones';
                        break;
                    }
                    break;
                  case '40':
                    switch ($dd->res_sin) {
                      case '100':
                      $respuesta='Si';
                      break;
                      case '75':
                      $respuesta='';
                      break;
                      case '25':
                      $respuesta='';
                      break;
                      case '0':
                      $respuesta='No';
                      break;
                    }
                    break;
                }
              @endphp
              @php
                if ($dd->res_sin==0) {
                  $color='danger';
                }
                else {
                  $color='success';
                }
              @endphp
              <tr class="{{$color}}">
                <td>{{$dd->des_sin}}</td>
                <td>{{$respuesta}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="form-control">
          <button type="button" name="button" data-toggle="modal" data-target="#miModal3" class="btn btn-raised btn-info"><i class="material-icons">repeat</i> Comparar con resultados anteriores</button>
        </div>
      </div>
      </div>
    </div>
    <a href="{{route('diagnostico.index')}}" class="btn btn-raised btn-success" title="Nuevo diagnostico"><i class="material-icons" >create</i>Nuevo diagnostico</a>
    <a href="{{route('index')}}" class="btn btn-raised btn-danger" title="Inicio"><i class="material-icons" >create</i>Terminar consulta</a>
  </div>
  </div>
  </div>

<div class="modal fade" id="miModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">ACERCA DE:</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <legend>{{$dia->dia_dia}}</legend>
          <div class="row form-group">
            @php
              $e1='La Leishmaniasis visceral es una enfermedad grave que afecta a personas y perros Si no se trata a tiempo daña al bazo, hígado, médula ósea y a otros órganos del cuerpo humano.';
              $e2='Es la forma más frecuente de Leishmaniasis, afecta a la piel y a la membrana mucosa de la persona, mismas dejan cicatrices de forma permanente.';
              $e3='Ocasiona la destrucción parcial o completa de las membranas mucosas de la nariz, la boca y la laringe, el cual genera dificultad al momento de tragar y hablar.';
              $e4='Se presenta con frecuencia en niños y niñas, en el inicio de la enfermedad se observa una inflamación en el sitio donde se encuentra la picadura. Estas inflamaciones se encuentran en cualquier parte del cuerpo, pero es más común en el rostro, brazos y piernas.';
              $e5='Comienza con el término de la fase aguda, el cual ocasiona daños en el corazón, en las vías digestivas y en el sistema nervioso.';
              $e6='Denominada también como fiebre palúdica o paludismo, es una enfermedad producida por parásitos del genero plasmodium.';
              $e7='El transmisor del dengue es el vector Aedes Aegypti, mismos se forman en agua acumulada en recipientes y en objetos en desuso. ';
              $e8='El dengue hemorrágico es una forma más severa del dengue clásico, puede ser fatal si no se trata adecuadamente, el principal síntoma es el sangrado en diferentes partes del cuerpo.';
              switch ($dia->dia_dia) {
                case 'Indicios de Leishmaniasis Visceral':
                  $er=$e1;
                  $fr='e1.png';
                  break;
                case 'Indicios de Dengue clasico':
                $er=$e7;
                $fr='e7.png';
                  break;
                case 'Malaria':
                $er=$e6;
                $fr='e6.png';
                  break;
                case 'Dengue clasico':
                $er=$e7;
                $fr='e7.png';
                  break;
                case 'Indicios de Dengue hemorragico':
                $er=$e8;
                $fr='e8.png';
                  break;
                case 'Chagas agudo':
                $er=$e4;
                $fr='e4.png';
                  break;
                case 'Dengue hemorragico':
                $er=$e8;
                $fr='e8.png';
                  break;
                case 'Leishmaniasis Visceral':
                $er=$e1;
                $fr='e1.png';
                  break;
                case 'Indicios de Leishmaniasis Cutanea o Mucocutanea':
                $er=$e2;
                $fr='e2.png';
                  break;
                case 'Indicios de Chagas cronico':
                $er=$e5;
                $fr='e5.png';
                  break;
                case 'Leishmaniasis Cutanea':
                $er=$e2;
                $fr='e2.png';
                  break;
                case 'Indicios de Leishmaniasis Mucocutanea':
                $er=$e3;
                $fr='e3.png';
                  break;
                case 'Leishmaniasis Mucocutanea':
                $er=$e3;
                $fr='e3.png';
                  break;
                case 'Chagas cronico':
                $er=$e5;
                $fr='e5.png';
                  break;
              }
            @endphp

            <div class="col-md-6">
              <span>{{$er}}</span>
            </div>
            <div class="col-md-5">
              <img src="{{url('images/acerca_de/'.$fr)}}" alt="">
            </div>
          </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons">close</i>Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="miModal3" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Comparar resultados</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-6">
          <p>Resultados anteriores</p>
          <div class="boxesContainer">
            <div class="cardBox">
              <div class="card2">
                <div class="front">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td width="80%">Fecha</td>
                        <td>Acciones</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dcom as $dc)
                        @if($dc->id_dpac == $dia->id_dpac && $dc->fec_dia != $dia->fec_dia)
                        <tr>
                          <td>{{$dc->fec_dia}}</td>
                          <td>
                            <button type="button" name="button" class="btn btn-raised btn-primary" onclick="rotar('{{$dc->id}}');">Ver</button>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="back">
                    <div class="" id="consulta">

                    </div>
                        <button type="button" class="btn btn-raised btn-warning" name="button" onclick="rotar2();">Comparar con otro resultado</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <p>Resultado actual</p>
                @php
                  $sum=0;
                  foreach ($dias as $ds):
                    $sum=$sum+$ds->res_sin;
                  endforeach;
                    $res=$sum/count($dias);
                @endphp
                <h4 class="label label-danger" style="font-size:1.3vw;">{{$dia->dia_dia}}
                  {{round($res,2).' %'}}
                </h4>
                <table class="table table-hover">
                  <thead>
                    <tr class="warning">
                      <td><b>Sintoma</b></td>
                      <td><b>Resultado</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dias as $dd)
                      @php
                        switch ($dd->id_ssin) {
                          case '1':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '2':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='39 °C';
                                break;
                              case '75':
                                $respuesta='38.5 °C';
                                break;
                              case '25':
                                $respuesta='37-38 °C';
                                break;
                              case '0':
                                $respuesta='36-37.5 °C';
                                break;
                            }
                            break;
                          case '3':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Dolor muy fuerte o insoportable';
                                break;
                              case '75':
                                $respuesta='Dolor fuerte';
                                break;
                              case '25':
                                $respuesta='Dolor leve';
                                break;
                              case '0':
                                $respuesta='Ausencia de dolor';
                                break;
                            }
                            break;
                          case '4':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cansancio al peinarse';
                                break;
                              case '75':
                                $respuesta='Cansancio al cambiarse de ropa';
                                break;
                              case '25':
                                $respuesta='Cansancio al subir las gradas';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '5':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Duración de semanas';
                                break;
                              case '75':
                                $respuesta='Duración de días';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '6':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '7':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Glóbulos distribuidos en todo el cuerpo';
                                break;
                              case '75':
                                $respuesta='Glóbulos rojos distribuidos desde la cabeza hasta el torso';
                                break;
                              case '25':
                                $respuesta='Glóbulos rojos distribuidos en la cabeza';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '8':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '9':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '10':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Dolor muy fuerte o insoportable';
                                break;
                              case '75':
                                $respuesta='Dolor fuerte';
                                break;
                              case '25':
                                $respuesta='Dolor leve';
                                break;
                              case '0':
                                $respuesta='Ausencia de dolor';
                                break;
                            }
                            break;
                          case '11':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '12':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '13':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '15':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='Rechazo al recibir alimento y fatiga';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '14':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Dolor muy fuerte o insoportable';
                                break;
                              case '75':
                                $respuesta='Dolor fuerte';
                                break;
                              case '25':
                                $respuesta='Dolor leve';
                                break;
                              case '0':
                                $respuesta='Ausencia de dolor';
                                break;
                            }
                            break;
                          case '16':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Eritema inflamatoria con presencia de pus';
                                break;
                              case '75':
                                $respuesta='Eritema inflamatoria';
                                break;
                              case '25':
                                $respuesta='Eritema conjuntiva';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '17':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '18':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '19':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '20':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '21':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '22':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Ganglios linfáticos inflamados en más de un lugar (Cuello, axilas o entrepiernas)';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='Ganglios inflamados en un solo lugar(Cuello, axilas o entrepiernas)';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '23':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='Rechazo al recibir alimento y fatiga';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '24':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '25':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '26':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Dolor muy fuerte o insoportable';
                                break;
                              case '75':
                                $respuesta='Dolor fuerte';
                                break;
                              case '25':
                                $respuesta='Dolor leve';
                                break;
                              case '0':
                                $respuesta='Ausencia de dolor';
                                break;
                            }
                            break;
                          case '27':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '28':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '29':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el hígado es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '30':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando el bazo es palpable en la cavidad abdominal';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='A la altura del reborde costal';
                                break;
                              case '0':
                                $respuesta='Debajo del reborde costal';
                                break;
                            }
                            break;
                          case '31':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='Rechazo al recibir alimento y fatiga';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '32':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '33':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Inflamación de la mucosa nasal más del 90%';
                                break;
                              case '75':
                                $respuesta='Inflamación de la mucosa nasal más del 50 %';
                                break;
                              case '25':
                                $respuesta='Inflamación de la mucosa nasal menos del 30%';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '34':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Existen síntomas permanentes en reposo que se intensifican con esfuerzos menores';
                                break;
                              case '75':
                                $respuesta='Limitación marcada para actividad física pero sin molestias durante el reposo';
                                break;
                              case '25':
                                $respuesta='Sin síntomas durante el reposo. Síntomas con grandes esfuerzos, leve limitación a actividad física';
                                break;
                              case '0':
                                $respuesta='Sin síntomas en relación a la actividad física actual';
                                break;
                            }
                            break;
                          case '35':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '36':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Cuando ingiere líquidos(Agua o jugos)';
                                break;
                              case '75':
                                $respuesta='Cuando ingiere alimentos semisólidos(La mermelada)';
                                break;
                              case '25':
                                $respuesta='Cuando ingiere alimentos solidos(La papa)';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '37':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '38':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Si';
                                break;
                              case '75':
                                $respuesta='';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='No';
                                break;
                            }
                            break;
                          case '39':
                            switch ($dd->res_sin) {
                              case '100':
                                $respuesta='Duración de semanas';
                                break;
                              case '75':
                                $respuesta='Duración de días';
                                break;
                              case '25':
                                $respuesta='';
                                break;
                              case '0':
                                $respuesta='Ninguna de las opciones';
                                break;
                            }
                            break;
                          case '40':
                            switch ($dd->res_sin) {
                              case '100':
                              $respuesta='Si';
                              break;
                              case '75':
                              $respuesta='';
                              break;
                              case '25':
                              $respuesta='';
                              break;
                              case '0':
                              $respuesta='No';
                              break;
                            }
                            break;
                        }
                      @endphp
                      @php
                        if ($dd->res_sin==0) {
                          $color='danger';
                        }
                        else {
                          $color='success';
                        }
                      @endphp
                      <tr class="{{$color}}">
                        <td>{{$dd->des_sin}}</td>
                        <td>{{$respuesta}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons">close</i>Cerrar</button>
      </div>
    </div>
</div>

@endsection
@section('script')
  <script type="text/javascript">
    function rotar(var1){
      $('.cardBox .card2').css('transform','rotateY(180deg)');
      $('.front').css('display','none');
      var parametros = {
                "id" : var1,
                "_token": "{{ csrf_token() }}"
        };
      $.ajax({
                data:  parametros,
                url:   'getConsulta',
                type:  'post',
                beforeSend: function () {
                        document.getElementById('consulta').innerHTML='<center><img src="{{url('images/cargando2.gif')}}" alt="cargando" /><br />Cargando .....</center>'
                },
                success:  function (data) {
                  var dhtml='<h4 class="label label-danger" style="font-size:1.3vw;">'+data.enf+' '+data.porcentaje+'%'+'</h4>';
                  var dhtml=dhtml+'<table class="table table-hover"><thead><tr class="warning"><td><b>Sintoma</b></td><td><b>Resultado</b></td></tr></thead><tbody>';
                  console.log(data.resp);
                  for (var i=0; i<data.sintomas.length; i++)
                  {
                    if(data.sintomas[i].res_sin==0){
                      var dhtml=dhtml+'<tr class="danger"><td>'+data.sintomas[i].des_sin+'</td><td>'+data.resp[i]+'</td></tr>';
                    }else{
                      var dhtml=dhtml+'<tr class="success"><td>'+data.sintomas[i].des_sin+'</td><td>'+data.resp[i]+'</td></tr>';
                    }
                  }
                  var dhtml=dhtml+'</tbody></table>';
                  $("#consulta").html(dhtml);
              }
      });
    }
    function rotar2(){
      $('.cardBox .card2').css('transform','rotateY(0deg)');
      $('.front').css('display','block');
    }
  </script>
@endsection
