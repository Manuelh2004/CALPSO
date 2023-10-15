<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class SensorModel extends Model
{
    protected $primaryKey = "sm_id";
    protected $table = "sensor_model";
    protected $fillable = [
        'sm_name',
        'sm_codename',
        'sm_brand',
        'sm_model',
        'parameter_id',
        'mu_id',
        'sm_max_limit',
        'sm_min_limit',
        'sm_status',
    ];


}
