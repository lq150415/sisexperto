<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\Paciente;
use experto\Reserva;
use experto\User;
use Illuminate\Support\Facades\Auth; //component of autentication data


class ReservasController extends Controller
{
    public function index(){
      $pacientes= Paciente::get();
      $reservas= Reserva::join('paciente','reserva.id_rpac','=','paciente.id')->join('users','reserva.id_rusu','=','users.id')->select('reserva.id','cod_res','fec_res','hor_res','nom_pac','pat_pac','mat_pac','nom_user','pat_user','mat_user')->get();
      return view('reservas.index')->with('pacientes',$pacientes)->with('reservas',$reservas);
    }
    public function storepac(Request $request){
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
      return redirect()->route('reservas.index')->with('mensaje',$mensaje);
    }
    public function store(Request $request){
      $reservas= new Reserva;
      $reservas->fec_res=$request->fec_res;
      $reservas->cod_res= 0;
      $reservas->hor_res=$request->hor_res;
      $reservas->id_rpac=$request->id_rpac;
      $reservas->id_rusu=Auth::user()->id;
      $reservas->save();
      $codigo=Reserva::find($reservas->id);
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
      $codigo->cod_res='RES-'.$code;
      $codigo->save();
      $mensaje=' ¡Reserva registrada correctamente!';
      return redirect()->route('reservas.index')->with('mensaje',$mensaje);
    }
    public function eliminar(Request $request){
      $reserva= Reserva::find($request->eid);
      $reserva->delete();
      $mensaje=' ¡Reserva eliminada!';
      return redirect()->route('reservas.index')->with('mensaje2',$mensaje);
    }
    public function actualizar(Request $request){
      $reservas= Reserva::find($request->mid);
      $reservas->fec_res= $request->mfec_res;
      $reservas->hor_res= $request->mhor_res;
      $reservas->save();

      $mensaje=' ¡Datos de reserva actualizados correctamente!';
      return redirect()->route('reservas.index')->with('mensaje',$mensaje);
    }
}
