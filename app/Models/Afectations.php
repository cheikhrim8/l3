<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afectations extends Model
{
 protected $fillable = [
  	'nom_dom','num_etager','num_rayon','num_bloc','statu'
  ];
}
