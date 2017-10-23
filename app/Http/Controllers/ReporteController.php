<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\User;
use experto\Sintoma;
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
     <tfoot>
      <tr class="danger">
      <td width="5%"><b>NRO</b></td>
      <td width="15%"><b>CI</b></td>
      <td width="20%"><b>NOMBRES</b></td>
      <td width="20%"><b>APELLIDOS</b></td>
      <td width="40%"><b>DIRECCION</b></td>
      </tr>
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
            <td width="30%">'.'Espere ...'.'</td>
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
            <td width="30%">'.'Espere ...'.'</td>
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
            <td width="30%">'.'Espere ...'.'</td>
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
            <td width="30%">'.'Espere ...'.'</td>
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

}
