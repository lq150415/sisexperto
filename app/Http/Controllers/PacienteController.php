<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;

class PacienteController extends Controller
{
    public function index(){
      $pacientes= Paciente::get();
      return view('paciente.index')->with('pacientes',$pacientes);
    }
    public function store(Request $request){
      $pacientes= new Paciente;
      $pacientes->cod_pac= 0;
      $pacientes->nom_pac= $request->nom_pac;
      $pacientes->pat_pac= $request->pat_pac;
      $pacientes->mat_pac= $request->mat_pac;
      $pacientes->fec_pac= $request->fec_pac;
      $pacientes->gen_pac= $request->gen_pac;
      $pacientes->ci_pac= $request->ci_pac;
      $pacientes->tel_pac= $request->tel_pac;
      $pacientes->ocu_pac= $request->ocu_pac;
      $pacientes->dir_pac= $request->dir_pac;
      $pacientes->save();
      $codigo=Paciente::find($pacientes->id);
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
      $codigo->cod_pac='PAC-'.$code;
      $codigo->save();

      $mensaje=' ¡Paciente registrado correctamente!';
      return redirect()->route('paciente.index')->with('mensaje',$mensaje);
    }
    public function actualizar(Request $request){
      $pacientes= Paciente::find($request->mid);
      $pacientes->nom_pac= $request->mnom_pac;
      $pacientes->pat_pac= $request->mpat_pac;
      $pacientes->mat_pac= $request->mmat_pac;
      $pacientes->fec_pac= $request->mfec_pac;
      $pacientes->gen_pac= $request->mgen_pac;
      $pacientes->ci_pac= $request->mci_pac;
      $pacientes->tel_pac= $request->mtel_pac;
      $pacientes->ocu_pac= $request->mocu_pac;
      $pacientes->dir_pac= $request->mdir_pac;
      $pacientes->save();

      $mensaje=' ¡Datos de paciente actualizados correctamente!';
      return redirect()->route('paciente.index')->with('mensaje',$mensaje);
    }
    public function eliminar(Request $request){
      $pacientes= Paciente::find($request->eid);
      $pacientes->delete();
      $mensaje=' ¡Paciente eliminado!';
      return redirect()->route('paciente.index')->with('mensaje2',$mensaje);

    }
}
