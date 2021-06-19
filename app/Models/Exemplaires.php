<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplaires extends Model
{
 protected $fillable = [
  	'date_entree','id_ouvrage'
  ];
}
