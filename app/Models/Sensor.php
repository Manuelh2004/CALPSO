<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class Sensor extends Model
{

    protected $primaryKey = "sensor_id";
    protected $table = "sensor";
    protected $fillable = [
        'sm_id',
        'sensor_codename',
        'sensor_serie',
        'sensor_status',
    ];



}
