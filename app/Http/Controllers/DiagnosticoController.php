<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\Sintoma;
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
  public function cancelar(){
    $pacientes= Paciente::get();
    $mensaje="Diagnostico cancelado";
    return redirect()->route('diagnostico.index')->with('mensaje2',$mensaje)->with('paciente',$pacientes);
  }
  public function motor_inferencia(){
    $preg=$_POST['preg'];
    $dia=$_POST['diag'];
    $res=$_POST['res'];
    $pac=$_POST['pac'];
    switch ($preg) {
        case '0':
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
              'preg' =>2,
              'pac' => $pac,
              'msg' => 'Setting created successfully',
            );
          return \Response::json($response);
        case '2':
        $pregunta= Sintoma::find(2);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=3;
        }else{
          $siguiente=4;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '3':
        $pregunta= Sintoma::find(3);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=5;
        }else{
          $siguiente=6;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '4':
        $pregunta= Sintoma::find(4);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=33;
        }else{
          $siguiente=34;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '5':
        $pregunta= Sintoma::find(5);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=7;
        }else{
          $siguiente=8;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '6':
        $pregunta= Sintoma::find(6);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=29;
        }else{
          $siguiente=100;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '7':
        $pregunta= Sintoma::find(7);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=9;
        }else{
          $siguiente=10;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '8':
        $pregunta= Sintoma::find(8);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=18;
        }else{
          $siguiente=19;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '9':
        $pregunta= Sintoma::find(9);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=11;
        }else{
          $siguiente=11;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '10':
        $pregunta= Sintoma::find(10);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=14;
        }else{
          $siguiente=101;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '11':
        $pregunta= Sintoma::find(11);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=12;
        }else{
          $siguiente=12;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '12':
        $pregunta= Sintoma::find(12);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=13;
        }else{
          $siguiente=13;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '13':
        $pregunta= Sintoma::find(13);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=102;
        }else{
          $siguiente=102;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '14':
        $pregunta= Sintoma::find(14);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=15;
        }else{
          $siguiente=15;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '15':
        $pregunta= Sintoma::find(15);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=16;
        }else{
          $siguiente=16;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '17':
        $pregunta= Sintoma::find(17);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=103;
        }else{
          $siguiente=103;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '18':
        $pregunta= Sintoma::find(18);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=20;
        }else{
          $siguiente=20;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '19':
        $pregunta= Sintoma::find(19);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=24;
        }else{
          $siguiente=104;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '20':
        $pregunta= Sintoma::find(20);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=21;
        }else{
          $siguiente=21;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '21':
        $pregunta= Sintoma::find(21);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=22;
        }else{
          $siguiente=22;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '22':
        $pregunta= Sintoma::find(22);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=23;
        }else{
          $siguiente=23;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '23':
        $pregunta= Sintoma::find(23);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=105;
        }else{
          $siguiente=105;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '24':
        $pregunta= Sintoma::find(24);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=25;
        }else{
          $siguiente=25;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '25':
        $pregunta= Sintoma::find(25);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=26;
        }else{
          $siguiente=26;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '26':
        $pregunta= Sintoma::find(26);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=27;
        }else{
          $siguiente=27;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '27':
        $pregunta= Sintoma::find(27);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=28;
        }else{
          $siguiente=28;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '28':
        $pregunta= Sintoma::find(28);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=106;
        }else{
          $siguiente=106;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '29':
        $pregunta= Sintoma::find(29);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=30;
        }else{
          $siguiente=30;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '30':
        $pregunta= Sintoma::find(30);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=31;
        }else{
          $siguiente=31;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '31':
        $pregunta= Sintoma::find(31);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=32;
        }else{
          $siguiente=32;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '32':
        $pregunta= Sintoma::find(32);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=107;
        }else{
          $siguiente=107;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '33':
        $pregunta= Sintoma::find(33);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=35;
        }else{
          $siguiente=108;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '34':
        $pregunta= Sintoma::find(34);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=38;
        }else{
          $siguiente=109;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '35':
        $pregunta= Sintoma::find(35);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=110;
        }else{
          $siguiente=36;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '36':
        $pregunta= Sintoma::find(36);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=37;
        }else{
          $siguiente=111;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '37':
        $pregunta= Sintoma::find(37);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=112;
        }else{
          $siguiente=112;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '38':
        $pregunta= Sintoma::find(38);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=39;
        }else{
          $siguiente=39;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '39':
        $pregunta= Sintoma::find(39);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=40;
        }else{
          $siguiente=40;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
        case '40':
        $pregunta= Sintoma::find(40);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res==100) {
          $siguiente=113;
        }else{
          $siguiente=113;
        }
        $response = array(
          'pregunta' => '¿'.$pregunta->des_sin.'?',
          'preg' =>$siguiente,
          'dia' => $diagnostico->id,
          'pac' => $pac,
        );
      return \Response::json($response);
      }
    }
}
