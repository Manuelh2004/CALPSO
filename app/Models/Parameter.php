<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class Parameter extends Model
{
    use HasFactory;

    protected $primaryKey = "parameter_id";
    protected $table = "parameter";
    protected $fillable = [
        'parameter_codename',
        'parameter_name',
        'parameter_description',
        'parameter_status'
    ];
}
