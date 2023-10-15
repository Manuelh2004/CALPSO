<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class MeasurementUnit extends Model
{
    protected $primaryKey = "mu_id";
    protected $table = "measurement_unit";
    protected $fillable = [
        'mu_code',
        'mu_group',
        'mu_status',
    ];


}

