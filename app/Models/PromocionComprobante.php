<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocionComprobante extends Model
{
    use HasFactory;
    protected $table = 'promocion_comprobante';
    protected $primaryKey = 'id_promocion_comprobante';

    protected $fillable = [
        'id_promocion',
        'id_comprobante_pago',
        'monto_descuento'
    ];
}
