<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promocion';
    protected $primaryKey = 'id_promocion';

    protected $fillable = [
        'nombre_promocion',
        'descripcion_promocion',
        'fecha_inicio',
        'fecha_fin',
        'estado_promocion'
    ];
}
