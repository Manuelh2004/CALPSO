<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;


   class Menu extends Model
   {
    protected $table = 'items_menu';
    protected $primarykey = 'id_item_menu';
    protected $fillable = ['nombre_item', 'descripcion','precio_item','id_categoria'];


    public function categoria() 
    {
        return $this->belongTo(categoria::class,'id_categoria');
    }

    public function detallesOrden()
    {
        return $this->hasMany(DetalleOrden::class, 'id_item_menu');
    }
   }