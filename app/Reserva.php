<?php

namespace experto;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table='reserva';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'cod_res','fec_res', 'hor_res','id_rpac','id_rusu'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [

  ];
}
