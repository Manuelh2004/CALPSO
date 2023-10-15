<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class ParameterSystemType extends Model
{
    use HasFactory;

    protected $primaryKey = "psis_type_code";
    protected $table = "parameter_system_type";
    
    protected $fillable = ['psis_type_description', 'user_creator_id', 'psis_type_status'];

}
