<?php

namespace experto\Http\Controllers;

use Illuminate\Http\Request;
use experto\User;

class UserController extends Controller
{
    public function registrar(Request $request){
      $user= new User;
      $user->cod_user=0;
      $user->nom_user=$request->nom_user;
      $user->pat_user=$request->pat_user;
      $user->mat_user=$request->mat_user;
      $user->ci_user=$request->ci_user;
      $user->fec_user=$request->fec_user;
      $user->nick_user=$request->nick_user;
      $user->password=bcrypt($request->password);
      $user->save();
      $codigo=User::find($user->id);
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
      $codigo->cod_user='USR-'.$code;
      $codigo->save();

      $mensaje='Usuario registrado correctamente';
      return redirect()->route('login')->with('mensaje',$mensaje);
    }
}
