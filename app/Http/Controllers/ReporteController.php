<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
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
          <td width="70%"><b>CONCEPTO</b></td>
          <td width="30%"><b>MONTO</b></td>
       </tr>
     </thead>
     <tbody>
       <tr>
        <td width="70%">SUELDO TOTAL</td>
        <td width="30%"> Bs. 1800</td>
       </tr>
     </tbody>
     <tfoot>
      <tr>
        <td class="footer"><b>TOTAL</b>
        </td>
        <td class="foot"><b>
        Bs.
        </b></td>
      </tr>
     </tfoot>
    </table>
    ';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Line ( 8, 265,205,265 ,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetFont('','B','7');
    $pdf->SetXY(8, 266);
    $pdf->Write(0,' Elaborado por: '.Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user.' | Fecha:'.Carbon::now(),'','',false);

    $pdf->Output('Boleta de pago.pdf');
    }
    public function mensual(){
      return view('reporte.index');
    }
    public function diario(){
      return view('reporte.index');
    }
    public function rango(Request $request){
      return view('reporte.index');
    }
    public function paciente(Request $request){
      return view('reporte.index');
    }

}
