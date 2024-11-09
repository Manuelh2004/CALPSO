<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEntrega extends Model
{
    use HasFactory;
    protected $table = 'detalle_entrega';
    protected $primaryKey = 'id_detalle_entrega';

    protected $fillable = [
        'id_metodo_entrega',
        'direccion_entrega',
        'estado_entrega',
        'comentario',
        'fecha',
        'hora '
    ];
}
