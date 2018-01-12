<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\Diagnostico;

class HistorialController extends Controller
{
  public function index(){
    $pacientes= Paciente::get();
    return view('historial.index')->with('pacientes',$pacientes);
  }
  public function historial($id){
    $paciente= Paciente::find($id);
    $diagnosticos= Diagnostico::where('id_dpac','=',$id)->join('users','id_dusu','=','users.id')->select('cod_dia','fec_dia','hor_dia','nom_user','pat_user','mat_user','diagnostico.id','dia_dia')->get();
    return view('historial.historial')->with('paciente',$paciente)->with('diagnosticos',$diagnosticos);
  }
}
