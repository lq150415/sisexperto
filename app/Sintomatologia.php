<?php

namespace experto;

use Illuminate\Database\Eloquent\Model;

class Sintomatologia extends Model
{
  protected $table='sintomatologia';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = [
    'id_ssin','res_sin','id_sdia'
];

/**
 * The attributes that should be hidden for arrays.
 *
 * @var array
 */
protected $hidden = [

];
}
