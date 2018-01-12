<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\Sintoma;
use experto\Sintomatologia;
use experto\Diagnostico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DiagnosticoController extends Controller
{
  public function index(){
    $pacientes= Paciente::get();
    return view('diagnostico.index')->with('pacientes',$pacientes);
  }
  public function diagnostico($id){
    $pacientes= Paciente::find($id);
    return view('diagnostico.evaluacion')->with('paciente',$pacientes);
  }
  public function cancelar($id){
    $pacientes= Paciente::get();
    $mensaje="Diagnostico cancelado";
    $dia= Diagnostico::find($id);
    $dias= Sintomatologia::where('id_sdia','=',$dia->id)->get();
    foreach ($dias as $d) {
      $d->delete();
    }
    $dia->delete();
    return redirect()->route('diagnostico.index')->with('mensaje2',$mensaje)->with('paciente',$pacientes);
  }
  public function detalles($id){
    $dia= Diagnostico::find($id);
    $dia->fin_dia=1;
    $dia->save();
    $mensaje= 'Consulta finalizada, ¡Aqui estan los resultados!';
    $dias= Sintomatologia::where('id_sdia','=',$dia->id)->join('sintoma','id_ssin','=','sintoma.id')->get();
    $dcom=Diagnostico::get();
    $scom=Sintomatologia::get();
    $pacientes= Paciente::find($dia->id_dpac);
    return view('diagnostico.detalles')->with('paciente',$pacientes)->with('dia',$dia)->with('mensaje',$mensaje)->with('dias',$dias)->with('dcom',$dcom)->with('scom',$scom)->with('id',$id);
  }
  public function consulta(){
      $id=$_POST['id'];
      $consulta= Diagnostico::find($id);
      $sintomas= Sintomatologia::where('id_sdia','=',$id)->join('sintoma','sintoma.id','=','sintomatologia.id_ssin')->get();
      $respuesta=array();
      foreach ($sintomas as $dd):
          switch ($dd->id_ssin) {
            case '1':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '2':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='39 °C';
                  break;
                case '75':
                  $respuesta[]='38.5 °C';
                  break;
                case '25':
                  $respuesta[]='37-38 °C';
                  break;
                case '0':
                  $respuesta[]='36-37.5 °C';
                  break;
              }
              break;
            case '3':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Dolor muy fuerte o insoportable';
                  break;
                case '75':
                  $respuesta[]='Dolor fuerte';
                  break;
                case '25':
                  $respuesta[]='Dolor leve';
                  break;
                case '0':
                  $respuesta[]='Ausencia de dolor';
                  break;
              }
              break;
            case '4':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cansancio al peinarse';
                  break;
                case '75':
                  $respuesta[]='Cansancio al cambiarse de ropa';
                  break;
                case '25':
                  $respuesta[]='Cansancio al subir las gradas';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '5':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Duración de semanas';
                  break;
                case '75':
                  $respuesta[]='Duración de días';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '6':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '7':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Glóbulos distribuidos en todo el cuerpo';
                  break;
                case '75':
                  $respuesta[]='Glóbulos rojos distribuidos desde la cabeza hasta el torso';
                  break;
                case '25':
                  $respuesta[]='Glóbulos rojos distribuidos en la cabeza';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '8':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '9':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el bazo es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '10':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Dolor muy fuerte o insoportable';
                  break;
                case '75':
                  $respuesta[]='Dolor fuerte';
                  break;
                case '25':
                  $respuesta[]='Dolor leve';
                  break;
                case '0':
                  $respuesta[]='Ausencia de dolor';
                  break;
              }
              break;
            case '11':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el hígado es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '12':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '13':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '15':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='Rechazo al recibir alimento y fatiga';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '14':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Dolor muy fuerte o insoportable';
                  break;
                case '75':
                  $respuesta[]='Dolor fuerte';
                  break;
                case '25':
                  $respuesta[]='Dolor leve';
                  break;
                case '0':
                  $respuesta[]='Ausencia de dolor';
                  break;
              }
              break;
            case '16':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Eritema inflamatoria con presencia de pus';
                  break;
                case '75':
                  $respuesta[]='Eritema inflamatoria';
                  break;
                case '25':
                  $respuesta[]='Eritema conjuntiva';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '17':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '18':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '19':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '20':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el bazo es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '21':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el hígado es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '22':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Ganglios linfáticos inflamados en más de un lugar (Cuello, axilas o entrepiernas)';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='Ganglios inflamados en un solo lugar(Cuello, axilas o entrepiernas)';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '23':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='Rechazo al recibir alimento y fatiga';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '24':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '25':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '26':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Dolor muy fuerte o insoportable';
                  break;
                case '75':
                  $respuesta[]='Dolor fuerte';
                  break;
                case '25':
                  $respuesta[]='Dolor leve';
                  break;
                case '0':
                  $respuesta[]='Ausencia de dolor';
                  break;
              }
              break;
            case '27':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '28':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '29':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el hígado es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '30':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando el bazo es palpable en la cavidad abdominal';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='A la altura del reborde costal';
                  break;
                case '0':
                  $respuesta[]='Debajo del reborde costal';
                  break;
              }
              break;
            case '31':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Pérdida de peso corporal, masa muscular y debilidad, estado de extrema desnutrición';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='Rechazo al recibir alimento y fatiga';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '32':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '33':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Inflamación de la mucosa nasal más del 90%';
                  break;
                case '75':
                  $respuesta[]='Inflamación de la mucosa nasal más del 50 %';
                  break;
                case '25':
                  $respuesta[]='Inflamación de la mucosa nasal menos del 30%';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '34':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Existen síntomas permanentes en reposo que se intensifican con esfuerzos menores';
                  break;
                case '75':
                  $respuesta[]='Limitación marcada para actividad física pero sin molestias durante el reposo';
                  break;
                case '25':
                  $respuesta[]='Sin síntomas durante el reposo. Síntomas con grandes esfuerzos, leve limitación a actividad física';
                  break;
                case '0':
                  $respuesta[]='Sin síntomas en relación a la actividad física actual';
                  break;
              }
              break;
            case '35':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '36':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Cuando ingiere líquidos(Agua o jugos)';
                  break;
                case '75':
                  $respuesta[]='Cuando ingiere alimentos semisólidos(La mermelada)';
                  break;
                case '25':
                  $respuesta[]='Cuando ingiere alimentos solidos(La papa)';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '37':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '38':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Si';
                  break;
                case '75':
                  $respuesta[]='';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='No';
                  break;
              }
              break;
            case '39':
              switch ($dd->res_sin) {
                case '100':
                  $respuesta[]='Duración de semanas';
                  break;
                case '75':
                  $respuesta[]='Duración de días';
                  break;
                case '25':
                  $respuesta[]='';
                  break;
                case '0':
                  $respuesta[]='Ninguna de las opciones';
                  break;
              }
              break;
            case '40':
              switch ($dd->res_sin) {
                case '100':
                $respuesta[]='Si';
                break;
                case '75':
                $respuesta[]='';
                break;
                case '25':
                $respuesta[]='';
                break;
                case '0':
                $respuesta[]='No';
                break;
              }
              break;
          }
        endforeach;
      $sum=0;
      foreach ($sintomas as $ds):
        $sum=$sum+$ds->res_sin;
      endforeach;
        $res=$sum/count($sintomas);
      $response = array(
        'enf' =>$consulta->dia_dia,
        'porcentaje' =>round($res,2),
        'sintomas' => $sintomas,
        'resp'=>$respuesta,
      );
      return \Response::json($response);

  }
  public function motor_inferencia(){
    $preg=$_POST['preg'];
    $dia=$_POST['diag'];
    $res=$_POST['res'];
    $pac=$_POST['pac'];
    $prev=$_POST['prev'];
    if($preg!=0):
    $sint= new Sintomatologia;
    $sint->id_ssin=$preg;
    $sint->res_sin=$res;
    $sint->id_sdia=$dia;
    $sint->save();
    endif;
//    dd($prev);
    switch ($preg) {
        case '0':
        if ($res>0) {
          $preg=1;
        }else{
          $preg=1;
        }
          break;
        case '1':
        if ($res>0) {
          $preg=2;
        }else{
          $preg=2;
        }
          break;
        case '2':
        if ($res>0) {
          $preg=3;
        }else{
          $preg=4;
        }
          break;
        case '3':
        if ($res>0) {
          $preg=5;
        }else{
          $preg=6;
        }
          break;
        case '4':
        if ($res>0) {
          $preg=33;
        }else{
          $preg=34;
        }
          break;
        case '5':
        if ($res>0) {
          $preg=7;
        }else{
          $preg=8;
        }
          break;
        case '6':
        if ($res>0) {
          $preg=29;
        }else{
          $preg=100;
        }
          break;
        case '7':
        if ($res>0) {
          $preg=9;
        }else{
          $preg=10;
        }
          break;
        case '8':
        if ($res>0) {
          $preg=18;
        }else{
          $preg=19;
        }
          break;
        case '9':
        if ($res>0) {
          $preg=11;
        }else{
          $preg=11;
        }
          break;
        case '10':
        if ($res>0) {
          $preg=14;
        }else{
          $preg=101;
        }
          break;
        case '11':
        if ($res>0) {
          $preg=12;
        }else{
          $preg=12;
        }
          break;
        case '12':
        if ($res>0) {
          $preg=13;
        }else{
          $preg=13;
        }
          break;
        case '13':
        if ($res>0) {
          $preg=102;
        }else{
          $preg=102;
        }
          break;
        case '14':
        if ($res>0) {
          $preg=15;
        }else{
          $preg=15;
        }
          break;
        case '15':
        if ($res>0) {
          $preg=16;
        }else{
          $preg=16;
        }
          break;
        case '16':
        if ($res>0) {
          $preg=17;
        }else{
          $preg=17;
        }
          break;
        case '17':
        if ($res>0) {
          $preg=103;
        }else{
          $preg=103;
        }
          break;
        case '18':
        if ($res>0) {
          $preg=20;
        }else{
          $preg=20;
        }
          break;
        case '19':
        if ($res>0) {
          $preg=24;
        }else{
          $preg=104;
        }
          break;
        case '20':
        if ($res>0) {
          $preg=21;
        }else{
          $preg=21;
        }
          break;
        case '21':
        if ($res>0) {
          $preg=22;
        }else{
          $preg=22;
        }
          break;
        case '22':
        if ($res>0) {
          $preg=23;
        }else{
          $preg=23;
        }
          break;
        case '23':
        if ($res>0) {
          $preg=105;
        }else{
          $preg=105;
        }
          break;
        case '24':
        if ($res>0) {
          $preg=25;
        }else{
          $preg=25;
        }
          break;
        case '25':
        if ($res>0) {
          $preg=26;
        }else{
          $preg=26;
        }
          break;
        case '26':
        if ($res>0) {
          $preg=27;
        }else{
          $preg=27;
        }
          break;
        case '27':
        if ($res>0) {
          $preg=28;
        }else{
          $preg=28;
        }
          break;
        case '28':
        if ($res>0) {
          $preg=106;
        }else{
          $preg=106;
        }
          break;
        case '29':
        if ($res>0) {
          $preg=30;
        }else{
          $preg=30;
        }
          break;
        case '30':
        if ($res>0) {
          $preg=31;
        }else{
          $preg=31;
        }
          break;
        case '31':
        if ($res>0) {
          $preg=32;
        }else{
          $preg=32;
        }
          break;
        case '32':
        if ($res>0) {
          $preg=107;
        }else{
          $preg=107;
        }
          break;
        case '33':
        if ($res>0) {
          $preg=35;
        }else{
          $preg=108;
        }
          break;
        case '34':
        if ($res>0) {
          $preg=38;
        }else{
          $preg=109;
        }
          break;
        case '35':
        if ($res>0) {
          $preg=110;
        }else{
          $preg=36;
        }
          break;
        case '36':
        if ($res>0) {
          $preg=37;
        }else{
          $preg=111;
        }
          break;
        case '37':
        if ($res>0) {
          $preg=112;
        }else{
          $preg=112;
        }
          break;
        case '38':
        if ($res>0) {
          $preg=39;
        }else{
          $preg=39;
        }
          break;
        case '39':
        if ($res>0) {
          $preg=40;
        }else{
          $preg=40;
        }
          break;
        case '40':
        if ($res>0) {
          $preg=113;
        }else{
          $preg=113;
        }
          break;
    }

    switch ($preg) {
        case '1':
            $pregunta= Sintoma::find(1);
            $diagnostico = new Diagnostico;
            $diagnostico->cod_dia=0;
            $diagnostico->fec_dia= Carbon::now()->format('Y-m-d');
            $diagnostico->hor_dia= Carbon::now()->format('H:i:s');
            $diagnostico->fin_dia=0;
            $diagnostico->id_dusu=Auth::user()->id;
            $diagnostico->id_dpac=$_POST['pac'];
            $diagnostico->id_dsint=0;
            $diagnostico->id_dtra=0;
            $diagnostico->save();
            $codigo=Diagnostico::find($diagnostico->id);
            if(strlen($codigo->id)==1){
              $code='000'.$codigo->id;
            }
            if(strlen($codigo->id)==2){
              $code='00'.$codigo->id;
            }
            if(strlen($codigo->id)==3){
              $code='0'.$codigo->id;
            }
            if(strlen($codigo->id)==4){
              $code=$codigo->id;
            }
            $codigo->cod_dia='DIA-'.$code;
            $codigo->save();
            $response = array(
              'pregunta' => '¿'.$pregunta->des_sin.'?',
              'preg' =>1,

              'dia' => $codigo->id,
              'pac' => $pac,
              'msg' => 'Setting created successfully',
            );
          return \Response::json($response);
        case '2':
        $pregunta= Sintoma::find(2);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>2,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '3':
        $pregunta= Sintoma::find(3);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>3,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '4':
        $pregunta= Sintoma::find(4);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>4,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '5':
        $pregunta= Sintoma::find(5);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>5,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '6':
        $pregunta= Sintoma::find(6);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>6,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Leishmaniasis Viceral',
        );
      return \Response::json($response);
        case '7':
        $pregunta= Sintoma::find(7);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>7,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '8':
        $pregunta= Sintoma::find(8);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>8,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '9':
        $pregunta= Sintoma::find(9);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>9,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '10':
        $pregunta= Sintoma::find(10);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>10,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Dengue clasico',
        );
      return \Response::json($response);
        case '11':
        $pregunta= Sintoma::find(11);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>11,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '12':
        $pregunta= Sintoma::find(12);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>12,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '13':
        $pregunta= Sintoma::find(13);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>13,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>'Malaria',
        );
      return \Response::json($response);
        case '14':
        $pregunta= Sintoma::find(14);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>14,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '15':
        $pregunta= Sintoma::find(15);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>15,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '16':
        $pregunta= Sintoma::find(15);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>16,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '17':
        $pregunta= Sintoma::find(17);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>17,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>'Dengue clasico',
        );
      return \Response::json($response);
        case '18':
        $pregunta= Sintoma::find(18);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>18,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '19':
        $pregunta= Sintoma::find(19);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>19,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Dengue hemorragico',
        );
      return \Response::json($response);
        case '20':
        $pregunta= Sintoma::find(20);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>20,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '21':
        $pregunta= Sintoma::find(21);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>21,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '22':
        $pregunta= Sintoma::find(22);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>22,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '23':
        $pregunta= Sintoma::find(23);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>23,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Chagas agudo',
        );
      return \Response::json($response);
        case '24':
        $pregunta= Sintoma::find(24);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>24,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '25':
        $pregunta= Sintoma::find(25);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>25,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '26':
        $pregunta= Sintoma::find(26);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>26,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '27':
        $pregunta= Sintoma::find(27);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>27,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '28':
        $pregunta= Sintoma::find(28);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>28,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Dengue hemorragico',
        );
      return \Response::json($response);
        case '29':
        $pregunta= Sintoma::find(29);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>29,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '30':
        $pregunta= Sintoma::find(30);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>30,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '31':
        $pregunta= Sintoma::find(31);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>31,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '32':
        $pregunta= Sintoma::find(32);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>32,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=> 'Leishmaniasis Visceral'
        );
      return \Response::json($response);
        case '33':
        $pregunta= Sintoma::find(33);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>33,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Leishmaniasis Cutanea o Mucocutanea',
        );
      return \Response::json($response);
        case '34':
        $pregunta= Sintoma::find(34);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>34,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Chagas Cronico',
        );
      return \Response::json($response);
        case '35':
        $pregunta= Sintoma::find(35);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>35,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Leishmaniasis Cutanea',
        );
      return \Response::json($response);
        case '36':
        $pregunta= Sintoma::find(36);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>36,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Indicios de Leishmaniasis Mucocutanea',
        );
      return \Response::json($response);
        case '37':
        $pregunta= Sintoma::find(37);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>37,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Leishmaniasis Mucocutanea',
        );
      return \Response::json($response);
        case '38':
        $pregunta= Sintoma::find(38);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>38,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '39':
        $pregunta= Sintoma::find(39);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>39,
          'dia' => $dia,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '40':
        $pregunta= Sintoma::find(40);
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>40,
          'dia' => $dia,
          'pac' => $pac,
          'enfermedad'=>' Chagas cronico',
        );
      return \Response::json($response);
      case '100':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Leishmaniasis Visceral';
      $diagnostico->save();
      $response = array(
        'preg' =>100,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Leishmaniasis Visceral',
      );
      return \Response::json($response);
      case '101':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Dengue clasico';
      $diagnostico->save();
      $response = array(
        'preg' =>101,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Dengue clasico',
      );
      return \Response::json($response);
      case '102':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Malaria';
      $diagnostico->save();
      $response = array(
        'preg' =>102,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Malaria',
      );
      return \Response::json($response);
      case '103':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Dengue clasico';
      $diagnostico->save();
      $response = array(
        'preg' =>103,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Dengue clasico',
      );
      return \Response::json($response);
      case '104':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Dengue hemorragico';
      $diagnostico->save();
      $response = array(
        'preg' =>104,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Dengue hemorragico',
      );
      return \Response::json($response);
      case '105':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Chagas agudo';
      $diagnostico->save();
      $response = array(
        'preg' =>105,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Chagas agudo',
      );
      return \Response::json($response);
      case '106':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Dengue hemorragico';
      $diagnostico->save();
      $response = array(
        'preg' =>106,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Dengue hemorragico',
      );
      return \Response::json($response);
      case '107':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Leishmaniasis Visceral';
      $diagnostico->save();
      $response = array(
        'preg' =>107,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Leishmaniasis Visceral',
      );
      return \Response::json($response);
      case '108':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Leishmaniasis Cutanea o Mucocutanea';
      $diagnostico->save();
      $response = array(
        'preg' =>108,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Leishmaniasis Cutanea o Mucocutanea',
      );
      return \Response::json($response);
      case '109':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Chagas cronico';
      $diagnostico->save();
      $response = array(
        'preg' =>109,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Chagas cronico',
      );
      return \Response::json($response);
      case '110':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Leishmaniasis Cutanea';
      $diagnostico->save();
      $response = array(
        'preg' =>110,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Leishmaniasis Cutanea',
      );
      return \Response::json($response);
      case '111':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Indicios de Leishmaniasis Mucocutanea';
      $diagnostico->save();
      $response = array(
        'preg' =>111,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Indicios de Leishmaniasis Mucocutanea',
      );
      return \Response::json($response);
      case '112':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Leishmaniasis Mucocutanea';
      $diagnostico->save();
      $response = array(
        'preg' =>112,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Leishmaniasis Mucocutanea',
      );
      return \Response::json($response);
      case '113':
      $diagnostico=Diagnostico::find($dia);
      $diagnostico->dia_dia='Chagas cronico';
      $diagnostico->save();
      $response = array(
        'preg' =>113,
        'dia' =>$dia,
        'pac' => $pac,
        'enfermedad'=>' Chagas cronico',
      );
      return \Response::json($response);
      }
    }
}
