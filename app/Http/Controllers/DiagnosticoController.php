<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;

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
              'pac' => $pac,
              'msg' => 'Setting created successfully',
            );
          return \Response::json($response);
        case '1':
        $pregunta= Sintoma::find(2);
        $diagnostico=Diagnostico::orderBy('id','DESC')->first();
        if ($res=='100') {
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
      }
    }
}
