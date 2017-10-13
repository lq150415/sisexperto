<?php

namespace experto;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table='paciente';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'cod_pac','nom_pac', 'pat_pac','mat_pac','fec_pac','gen_pac','ci_pac','tel_pac','ocu_pac','dir_pac'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [

  ];
}
