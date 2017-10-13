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
      
    }
}
