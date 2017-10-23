<?php

namespace experto;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table='sintoma';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'cod_sin','nom_sin', 'des_sin'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [

  ];
}
