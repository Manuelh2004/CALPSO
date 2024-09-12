<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class DetalleOrden extends Model
{
    protected $table = 'detalle_ordenes';
    protected $primaryKey = 'id_detalle_orden';
    protected $fillable = ['id_orden', 'id_item_menu', 'cantidad', 'sub_total_orden'];

    // Relaciones
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'id_orden');
    }

    public function itemMenu()
    {
        return $this->belongsTo(ItemMenu::class, 'id_item_menu');
    }
}
