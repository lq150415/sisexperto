<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\User;
use experto\Sintoma;
use experto\Sintomatologia;
use experto\Diagnostico;
use Carbon\Carbon;
use PDF; // at the top of the file
use TCPDF; // at the top of the file
use Illuminate\Support\Facades\Auth;


class ReporteController extends Controller
{
    public function index(){
      return view('reporte.index');
    }
    public function general(){
    $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
    $pdf->SetTitle('REPORTE GENERAL - SISTEMA EXPERTO');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetMargins(15, 15, 10);
    $pdf->AddPage();
    $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

    //DATOS
    $pdf->SetFont('','','10');
    $pdf->SetXY(8, 8);
    $pdf->Write(0,'REPORTE SISTEMA EXPERTO - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
    $pdf->Line ( 5, 15,155,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

    //CABECERA
    $pdf->SetFont('','B','11');
    $pdf->SetXY(72, 20);
    $pdf->Write(0,'LISTA DE PACIENTES REGISTRADOS','','',false);
    $pdf->SetFont('','B','10');
    $pdf->SetXY(8, 30);
    $pdf->Write(0,'FECHA:','','',false);
    $pdf->SetFont('','','10');
    $pdf->SetXY(23, 30);
    $pdf->Write(0,Carbon::now()->format('d-m-Y'),'','',false);
    $pdf->SetFont('','B','10');

    //DETALLE
    $pdf->SetXY(8, 40);
    $pdf->SetFont('','','9');

    $pacientes=Paciente::get();
    $html='
    <style>
    .head{
      background-color: #fb8213;
    }
    .footer{
      background-color: #fb4413;
    }
    .foot{
      background-color: #13fb7e;
    }
    .danger{
      background-color: #e34444;
    }
    </style>
    <table border="1" cellpadding="4" >
     <thead>
       <tr class="head">
          <td width="5%"><b>NRO</b></td>
          <td width="15%"><b>CI</b></td>
          <td width="20%"><b>NOMBRES</b></td>
          <td width="20%"><b>APELLIDOS</b></td>
          <td width="40%"><b>DIRECCION</b></td>
       </tr>
     </thead>
     <tbody>';
     foreach ($pacientes as $key => $paciente) {
       $html=$html.'
       <tr>
          <td width="5%">'.($key+1).'</td>
          <td width="15%">'.$paciente->ci_pac.'</td>
          <td width="20%">'.$paciente->nom_pac.'</td>
          <td width="20%">'.$paciente->pat_pac.' '.$paciente->mat_pac.'</td>
          <td width="40%">'.$paciente->dir_pac.'</td>
       </tr>';
     }
     $html=$html.'</tbody>
    </table>
    ';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetFont('','B','7');
    $pdf->SetXY(8, 266);
    $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

    $pdf->Output('Reporte general.pdf');
    }
    public function mensual(){
      $diagnosticos=Diagnostico::whereRaw('MONTH(fec_dia)=MONTH(CURRENT_DATE) and YEAR(fec_dia)=YEAR(CURRENT_DATE)')->get();
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE ENTRE FECHAS - SISTEMA EXPERTO');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'REPORTE SISTEMA EXPERTO - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 5, 15,155,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      //CABECERA
      $dia=Carbon::now()->format('d');
      $mes=Carbon::now()->format('m');
      if($mes==1):
        $mes='ENERO';
      elseif($mes==2):
        $mes='FEBRERO';
      elseif($mes==3):
        $mes='MARZO';
      elseif($mes==4):
        $mes='ABRIL';
      elseif($mes==5):
        $mes='MAYO';
      elseif($mes==6):
        $mes='JUNIO';
      elseif($mes==7):
        $mes='JULIO';
      elseif($mes==8):
        $mes='AGOSTO';
      elseif($mes==9):
        $mes='SEPTIEMBRE';
      elseif($mes==10):
        $mes='OCTUBRE';
      elseif($mes==11):
        $mes='NOVIEMBRE';
      elseif($mes==12):
        $mes='DICIEMBRE';
      endif;
      $año=Carbon::now()->format('Y');
      $fecha=$dia.' de '.$mes.' del '.$año;
      $pdf->SetFont('','B','11');
      $pdf->SetXY(55, 30);
      $pdf->Write(0,'EVALUACIONES REALIZADAS EN EL MES DE '.$mes,'','',false);

      //DETALLE
      $pdf->SetXY(8, 40);
      $pdf->SetFont('','','9');

      $html='
      <style>
      .head{
        background-color: #fbc813;
      }
      .footer{
        background-color: #fb4413;
      }
      .foot{
        background-color: #13fb7e;
      }
      .danger{
        background-color: #444ae3;
      }
      </style>
      <table border="1" cellpadding="4" >
       <thead>
         <tr class="head">
            <th width="10%"><b>CODIGO</b></th>
            <th width="20%"><b>FECHA</b></th>
            <th width="20%"><b>HORA</b></th>
            <th width="20%"><b>MEDICO</b></th>
            <th width="30%"><b>DIAGNOSTICO</b></th>
         </tr>
       </thead>
       <tbody>';
       if((count($diagnosticos))==0):
         $html=$html.'
         <tr>
          <td width="100%">
             NO HAY DATOS PARA MOSTRAR
          </td>
         </tr>';
       else:
         foreach ($diagnosticos as $diagnostico) {
         $medico=User::find($diagnostico->id_dusu);
         $html=$html.'
         <tr>
            <td width="10%">'.$diagnostico->cod_dia.'</td>
            <td width="20%">'.$diagnostico->fec_dia.'</td>
            <td width="20%">'.$diagnostico->hor_dia.'</td>
            <td width="20%">'.$medico->nom_user.' '.$medico->pat_user.' '.$medico->mat_user.'</td>
            <td width="30%">'.$diagnostico->dia_dia.'</td>
         </tr>';
       }
      endif;
       $html=$html.'</tbody>
       <tfoot>

       </tfoot>
      </table>
      ';

      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->Output('Reporte mensual.pdf');

    }
    public function diario(){
      $diagnosticos=Diagnostico::whereRaw('DATE(fec_dia)=CURRENT_DATE')->get();
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE DIARIO - SISTEMA EXPERTO');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'REPORTE SISTEMA EXPERTO - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 5, 15,155,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      //CABECERA
      $dia=Carbon::now()->format('d');
      $mes=Carbon::now()->format('m');
      if($mes==1):
        $mes='ENERO';
      elseif($mes==2):
        $mes='FEBRERO';
      elseif($mes==3):
        $mes='MARZO';
      elseif($mes==4):
        $mes='ABRIL';
      elseif($mes==5):
        $mes='MAYO';
      elseif($mes==6):
        $mes='JUNIO';
      elseif($mes==7):
        $mes='JULIO';
      elseif($mes==8):
        $mes='AGOSTO';
      elseif($mes==9):
        $mes='SEPTIEMBRE';
      elseif($mes==10):
        $mes='OCTUBRE';
      elseif($mes==11):
        $mes='NOVIEMBRE';
      elseif($mes==12):
        $mes='DICIEMBRE';
      endif;
      $año=Carbon::now()->format('Y');
      $fecha=$dia.' de '.$mes.' del '.$año;
      $pdf->SetFont('','B','11');
      $pdf->SetXY(55, 30);
      $pdf->Write(0,'EVALUACIONES REALIZADAS EL '.$fecha,'','',false);

      //DETALLE
      $pdf->SetXY(8, 40);
      $pdf->SetFont('','','9');

      $html='
      <style>
      .head{
        background-color: #13fb77;
      }
      .footer{
        background-color: #fb4413;
      }
      .foot{
        background-color: #13fb7e;
      }
      .danger{
        background-color: #444ae3;
      }
      </style>
      <table border="1" cellpadding="4" >
       <thead>
         <tr class="head">
            <th width="10%"><b>CODIGO</b></th>
            <th width="20%"><b>FECHA</b></th>
            <th width="20%"><b>HORA</b></th>
            <th width="20%"><b>MEDICO</b></th>
            <th width="30%"><b>DIAGNOSTICO</b></th>
         </tr>
       </thead>
       <tbody>';
       if((count($diagnosticos))==0):
         $html=$html.'
         <tr>
          <td width="100%">
             NO HAY DATOS PARA MOSTRAR
          </td>
         </tr>';
       else:
         foreach ($diagnosticos as $diagnostico) {
         $medico=User::find($diagnostico->id_dusu);
         $html=$html.'
         <tr>
            <td width="10%">'.$diagnostico->cod_dia.'</td>
            <td width="20%">'.$diagnostico->fec_dia.'</td>
            <td width="20%">'.$diagnostico->hor_dia.'</td>
            <td width="20%">'.$medico->nom_user.' '.$medico->pat_user.' '.$medico->mat_user.'</td>
            <td width="30%">'.$diagnostico->dia_dia.'</td>
         </tr>';
       }
      endif;
       $html=$html.'</tbody>
       <tfoot>

       </tfoot>
      </table>
      ';

      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->Output('Reporte general.pdf');

    }
    public function rango(Request $request){
      $fecha_inicio = strtotime($request->inicio);
      $fecha_fin = strtotime($request->fin);
      if($fecha_inicio > $fecha_fin):
        $mensaje='La fecha de inicio no puede ser mayor a la fecha final';
        return redirect()->route('reporte.index')->with('mensaje2',$mensaje);
      else:
      $diagnosticos=Diagnostico::whereBetween('fec_dia', [$request->inicio, $request->fin])->get();
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE ENTRE FECHAS - SISTEMA EXPERTO');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'REPORTE SISTEMA EXPERTO - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 5, 15,155,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      //CABECERA
      $pdf->SetFont('','B','11');
      $pdf->SetXY(45, 30);
      $pdf->Write(0,'EVALUACIONES REALIZADAS DESDE EL '.Carbon::createFromFormat('Y-m-d',$request->inicio)->format('d-m-Y').' AL '.Carbon::createFromFormat('Y-m-d',$request->fin)->format('d-m-Y'),'','',false);

      //DETALLE
      $pdf->SetXY(8, 40);
      $pdf->SetFont('','','9');

      $html='
      <style>
      .head{
        background-color: #13fb77;
      }
      .footer{
        background-color: #fb4413;
      }
      .foot{
        background-color: #13fb7e;
      }
      .danger{
        background-color: #444ae3;
      }
      </style>
      <table border="1" cellpadding="4" >
       <thead>
         <tr class="head">
            <th width="10%"><b>CODIGO</b></th>
            <th width="20%"><b>FECHA</b></th>
            <th width="20%"><b>HORA</b></th>
            <th width="20%"><b>MEDICO</b></th>
            <th width="30%"><b>DIAGNOSTICO</b></th>
         </tr>
       </thead>
       <tbody>';
       if((count($diagnosticos))==0):
         $html=$html.'
         <tr>
          <td width="100%">
             NO HAY DATOS PARA MOSTRAR
          </td>
         </tr>';
       else:
         foreach ($diagnosticos as $diagnostico) {
         $medico=User::find($diagnostico->id_dusu);
         $html=$html.'
         <tr>
            <td width="10%">'.$diagnostico->cod_dia.'</td>
            <td width="20%">'.$diagnostico->fec_dia.'</td>
            <td width="20%">'.$diagnostico->hor_dia.'</td>
            <td width="20%">'.$medico->nom_user.' '.$medico->pat_user.' '.$medico->mat_user.'</td>
            <td width="30%">'.$diagnostico->dia_dia.'</td>
         </tr>';
       }
      endif;
       $html=$html.'</tbody>
       <tfoot>

       </tfoot>
      </table>
      ';

      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->Output('Reporte general.pdf');

      endif;
    }
    public function paciente(Request $request){
      $paciente=Paciente::find($request->paciente);
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE POR PACIENTE - SISTEMA EXPERTO');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'REPORTE SISTEMA EXPERTO - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 5, 15,155,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      //CABECERA
      $pdf->SetFont('','B','11');
      $pdf->SetXY(72, 20);
      $pdf->Write(0,'REPORTE POR PACIENTES','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 25);
      $pdf->Write(0,'Datos del paciente','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 37);
      $pdf->Write(0,'Nombres: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 44);
      $pdf->Write(0,'Apellidos: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 51);
      $pdf->Write(0,'C.I. :','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 58);
      $pdf->Write(0,'Fecha de nacimiento: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 65);
      $pdf->Write(0,'Direccion: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 72);
      $pdf->Write(0,'Ocupacion: ','','',false);

      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 37);
      $pdf->Write(0,$paciente->nom_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 44);
      $pdf->Write(0,$paciente->pat_pac.' '.$paciente->mat_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(20, 51);
      $pdf->Write(0,$paciente->ci_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(45, 58);
      $pdf->Write(0,$paciente->fec_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 65);
      $pdf->Write(0,$paciente->dir_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 72);
      $pdf->Write(0,$paciente->ocu_pac,'','',false);

      $pdf->SetFont('','B','10');
      $pdf->SetXY(68, 80);
      $pdf->Write(0,'DIAGNOSTICOS REALIZADOS','','',false);

      //DETALLE
      $pdf->SetXY(8, 90);
      $pdf->SetFont('','','9');

      $diagnosticos=Diagnostico::where('id_dpac','=',$paciente->id)->get();
      $html='
      <style>
      .head{
        background-color: #33fb13;
      }
      .footer{
        background-color: #fb4413;
      }
      .foot{
        background-color: #13fb7e;
      }
      .danger{
        background-color: #44e3e3;
      }
      </style>
      <table border="1" cellpadding="4" >
       <thead>
         <tr class="head">
            <th width="10%"><b>CODIGO</b></th>
            <th width="20%"><b>FECHA</b></th>
            <th width="20%"><b>HORA</b></th>
            <th width="20%"><b>MEDICO</b></th>
            <th width="30%"><b>DIAGNOSTICO</b></th>
         </tr>
       </thead>
       <tbody>';
       foreach ($diagnosticos as $diagnostico) {
         $medico=User::find($diagnostico->id_dusu);
         $html=$html.'
         <tr>
            <td width="10%">'.$diagnostico->cod_dia.'</td>
            <td width="20%">'.$diagnostico->fec_dia.'</td>
            <td width="20%">'.$diagnostico->hor_dia.'</td>
            <td width="20%">'.$medico->nom_user.' '.$medico->pat_user.' '.$medico->mat_user.'</td>
            <td width="30%">'.$diagnostico->dia_dia.'</td>
         </tr>';
       }
       $html=$html.'</tbody>
       <tfoot>

       </tfoot>
      </table>
      ';

      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->Output('Reporte general.pdf');
    }
    public function tratamiento($id){
      $dia=Diagnostico::find($id);
      $dias=Sintomatologia::where('id_sdia','=',$id)->join('sintoma','sintoma.id','=','id_ssin')->get();
      $paciente= Paciente::find($dia->id_dpac);
      $edad = Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('Y');
      $edad2 = Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('m');
      $edad3 = Carbon::createFromFormat('Y-m-d', $paciente->fec_pac)->format('d');
      $date = Carbon::createFromDate($edad,$edad2,$edad3)->age;
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('TRATAMIENTOS ('.strtoupper($dia->dia_dia).') - SISTEMA EXPERTO');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'TRATAMIENTO PARA: '.strtoupper($dia->dia_dia).'  - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 8, 15,170,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));


      //CABECERA
      $pdf->Line ( 10, 35,205,35 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0, 0, 0)));
      $pdf->Line ( 10, 35,10,80 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0, 0, 0)));
      $pdf->Line ( 10, 80,205,80 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0, 0, 0)));
      $pdf->Line ( 205, 35,205,80 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0, 0, 0)));

      $pdf->SetFont('','B','11');
      $pdf->SetXY(72, 20);
      $pdf->Write(0,'TRATAMIENTO DE ENFERMEDADES','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 25);
      $pdf->Write(0,'Datos del paciente','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 37);
      $pdf->Write(0,'Nombres: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 44);
      $pdf->Write(0,'Apellidos: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 51);
      $pdf->Write(0,'C.I. :','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 58);
      $pdf->Write(0,'Fecha de nacimiento: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 65);
      $pdf->Write(0,'Direccion: ','','',false);
      $pdf->SetFont('','B','10');
      $pdf->SetXY(12, 72);
      $pdf->Write(0,'Ocupacion: ','','',false);

      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 37);
      $pdf->Write(0,$paciente->nom_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 44);
      $pdf->Write(0,$paciente->pat_pac.' '.$paciente->mat_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(20, 51);
      $pdf->Write(0,$paciente->ci_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(49, 58);
      $pdf->Write(0,$paciente->fec_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(30, 65);
      $pdf->Write(0,$paciente->dir_pac,'','',false);
      $pdf->SetFont('','','10');
      $pdf->SetXY(32, 72);
      $pdf->Write(0,$paciente->ocu_pac,'','',false);

      switch ($dia->dia_dia) {
        case 'Indicios de Leishmaniasis Visceral':
          $fr='f1.png';
          if($date<15):
          $trat='•	Anfotericina B IV: Iniciar con 0,25 mg/kg hasta 1 mg /kg diluido en 500 ml de solución dextrosa al 5% goteo lento protegido de la luz hasta completar dosis acumulativa de 1,5 mg, el tratamiento puede durar de 20 a 40 días de acuerdo a respuesta clínica.';
          else:
          $trat='•	Anfotericina B IV: Iniciar con 0,25 mg/kg hasta 1 mg /kg diluido en 500 ml de solución dextrosa al 5% goteo lento protegido de la luz hasta completar dosis acumulativa de 1,5 mg, el tratamiento puede durar de 20 a 40 días de acuerdo a respuesta clínica.';
          endif;
          break;
        case 'Indicios de Dengue clasico':
        $fr='f7.png';
        $trat='Se recomienda internacion';
          break;
        case 'Malaria':
        $fr='f6.png';
        $trat='•	Primer día: Cloroquina 4 comprimidos y primaquina 1 comprimido vía oral.
        •	Segundo y tercer día: Cloroquina 3 comprimidos y primaquina 1 comprimido vía oral.
        •	Cuarto al decimocuarto días: Primaquina 2 comprimidos vía oral.
        ';
          break;
        case 'Dengue clasico':
        $fr='f7.png';
        $trat='Se recomienda internacion';
        break;
        case 'Indicios de Dengue hemorragico':
        $fr='f8.png';
        $trat='Se recomienda internacion';
          break;
        case 'Chagas agudo':
        $fr='f4.png';
        $trat='•	Benznidazol: 5-7 mg/2g de peso /día vía oral por 3 días, si existe buena tolerancia 100 mg día hasta el 5 día. Posteriormente 300 mg/día hasta complementar 30 – 60 días.';
          break;
        case 'Dengue hemorragico':
        $fr='f8.png';
        $trat='Se recomienda internacion';
          break;
        case 'Leishmaniasis Visceral':
        $fr='f1.png';
        if($date<15):
        $trat='•	Anfotericina B IV: Iniciar con 0,25 mg/kg hasta 1 mg /kg diluido en 500 ml de solución dextrosa al 5% goteo lento protegido de la luz hasta completar dosis acumulativa de 1,5 mg, el tratamiento puede durar de 20 a 40 días de acuerdo a respuesta clínica.';
        else:
        $trat='•	Anfotericina B IV: Iniciar con 0,25 mg/kg hasta 1 mg /kg diluido en 500 ml de solución dextrosa al 5% goteo lento protegido de la luz hasta completar dosis acumulativa de 1,5 mg, el tratamiento puede durar de 20 a 40 días de acuerdo a respuesta clínica.';
        endif;
        break;
        case 'Indicios de Leishmaniasis Cutanea o Mucocutanea':
        $fr='f2.png';
        if($date<15):
          $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg /día durante 20 días
          •	Pentostan IV: Dosis lento recomendada por la OMS es de 20 mg de antimonio pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
          ';
        else:
          $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg/día durante 20 días
          •	Pentostam IV: Dosis lento recomendada por la OMS es de 20 mg de antimoniato pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
          ';
        endif;
          break;
        case 'Indicios de Chagas cronico':
        $fr='f5.png';
        $trat='•	Tratamiento quirúrgico: implantación de marcapaso cardíaco, en caso de megacolon y megaesofago.';
          break;
        case 'Leishmaniasis Cutanea':
        if($date<15):
          $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg /día durante 20 días
          •	Pentostan IV: Dosis lento recomendada por la OMS es de 20 mg de antimonio pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
          ';
        else:
          $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg/día durante 20 días
          •	Pentostam IV: Dosis lento recomendada por la OMS es de 20 mg de antimoniato pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
          ';
        endif;
        break;
        case 'Indicios de Leishmaniasis Mucocutanea':
        $fr='f3.png';
        $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg/día durante 20 días, Pentostam IV: Dosis lento recomendada por la OMS es de 20 mg de antimoniato pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
        •	Tratamiento quirúrgico, cirugía estética o reparadora en caso necesario.
        ';
          break;
        case 'Leishmaniasis Mucocutanea':
        $fr='f3.png';
        $trat='•	Antimonio de meglumina – glucantime IM: 20 mg/kg/día durante 20 días, Pentostam IV: Dosis lento recomendada por la OMS es de 20 mg de antimoniato pentavalente (0,2 ml de estibogluconato de sodio) kg/día lento no menos de 15 minutos por 20 días.
        •	Tratamiento quirúrgico, cirugía estética o reparadora en caso necesario.
        ';
          break;
        case 'Chagas cronico':
        $fr='f5.png';
        $trat='•	Tratamiento quirúrgico: implantación de marcapaso cardíaco, en caso de megacolon y megaesofago.';
          break;
      }
      $pdf->Image('images/acerca_de/'.$fr, 30, 90, 150, 50, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);


      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 85);
      $pdf->Write(0,'Acerca de la enfermedad','','',false);

      //DETALLE
      $pdf->SetXY(8, 140);
      $pdf->Write(0,'Sintomas: ','','',false);
      $pdf->SetXY(12, 150);
      $pdf->SetFont('','','9');

      $diagnosticos=Diagnostico::where('id_dpac','=',$paciente->id)->get();
      $html='
      <style>
      .head{
        background-color: #8a13c9;
      }
      .footer{
        background-color: #fb4413;
      }
      .foot{
        background-color: #13fb7e;
      }
      .danger{
        background-color: #44e3e3;
      }
      </style>
      <table border="1" cellpadding="4" >
       <thead>
         <tr class="head">
            <th width="60%"><b>SINTOMA</b></th>
            <th width="40%"><b>RESULTADO</b></th>
         </tr>
       </thead>
       <tbody>';
       foreach ($dias as $dd) {
         switch ($dd->id_ssin) {
           case '1':
             switch ($dd->res_sin) {
               case '100':
                 $respuesta='SI';
                 break;
               case '0':
                 $respuesta='NO';
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
         $html=$html.'
         <tr>
            <td width="60%">'.$dd->des_sin.'</td>
            <td width="40%">'.$respuesta.'</td>
         </tr>';
       }
       $html=$html.'</tbody>
       <tfoot>

       </tfoot>
      </table>
      ';
      $sum=0;
      foreach ($dias as $ds):
        $sum=$sum+$ds->res_sin;
      endforeach;
      $res=$sum/count($dias);
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->AddPage();
      $pdf->Image('images/unifranz.png', 170, 0, 40, 35, 'PNG', '', '', true, 600, '', false, false, false, false, false, false);

      //DATOS
      $pdf->SetFont('','','10');
      $pdf->SetXY(8, 8);
      $pdf->Write(0,'TRATAMIENTO PARA: '.strtoupper($dia->dia_dia).'  - UNIVERSIDAD PRIVADA FRANZ TAMAYO','','',false);
      $pdf->Line ( 8, 15,170,15 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetFont('','B','10');
      $pdf->SetXY(8, 25);
      $pdf->Write(0,'Diagnostico y tratamiento: ','','',false);
      $pdf->SetXY(12,32);
      $pdf->SetFont('','','10');
      $pdf->Write(0,'El paciente presenta un cuadro de: '.$dia->dia_dia.' en un ','','',false);
      $pdf->SetXY(92,38);
      $pdf->SetFont('','B','17');
      $pdf->Write(0,round($res,2).' %','','',false);
      $pdf->SetXY(12,47);
      $pdf->SetFont('','B','10');
      $pdf->Write(0,'Para ello se recomienda: ','','',false);
      $pdf->SetFont('','','10');
      $pdf->Write(0,$trat,'','',false);

      $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','7');
      $pdf->SetXY(8, 266);
      $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

      $pdf->Output('Reporte general.pdf');
    }

}
