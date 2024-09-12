<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Orden extends Model
{
    protected $table = 'ordenes';
    protected $primaryKey = 'id_orden';
    protected $fillable = ['id_cliente', 'id_sucursal', 'id_empleado', 'fecha_orden', 'total_orden'];

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class, 'id_orden');
    }
}
