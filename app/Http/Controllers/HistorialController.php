<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;

class HistorialController extends Controller
{
  public function index(){
    $pacientes= Paciente::get();
    return view('historial.index')->with('pacientes',$pacientes);
  }
  public function historial($id){
    $paciente= Paciente::find($id);
    return view('historial.historial')->with('paciente',$paciente);
  }
}
