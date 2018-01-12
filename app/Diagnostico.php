<?php

namespace experto;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
  protected $table='diagnostico';

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'cod_dia','fec_dia', 'hor_dia','fin_dia','id_usu','id_enf','dia_dia'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [

  ];
}
