<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class ItemMenu extends Model
{
    use HasFactory;
    protected $table = 'item_menu';
    protected $primaryKey = 'id_item_menu';

    protected $fillable = [
        'id_categoria',
        'nombre_item',
        'descripcion',
        'precio_item',
        'estado'
    ];
    static public function listado_datatable ($columnName, $columnSortOrder, $searchValue, $start, $rowperpage){
        if($rowperpage < 0){
            $rowperpage = null;
        }

        return DB::select(
            DB::raw("
                with
                    datos_input as (
                        select
                        :skip::int as start,
                        :rowperpage::int as rowperpage,
                        :searchvalue::varchar(50) as palabra
                    ),
              					item_menu_datos as (
                    select
                        im.id_item_menu
                        ,c.nombre_categoria
                        ,im.nombre_item
                        ,im.descripcion
                        ,im.precio_item
                        ,im.estado
                        ,count(im.id_item_menu) over() as totalrecords
                        from item_menu im
                        JOIN categoria c ON c.id_categoria = im.id_categoria
                ),
                item_menu_busqueda as (
                    select p.* , count(id_item_menu) over() as totalrecordswithfilter
                    from item_menu_datos p
                    cross join datos_input di
                    where nombre_item ilike  '%'||di.palabra||'%'
                ),
                item_menu_paginado as (
                    select
                    *
                    from item_menu_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from item_menu_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_item_menu, $data){
        if(empty($id_item_menu) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_item_menu", $id_item_menu)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }
    static public function crear($data){
        $res = self::create($data);
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha podido registrar");
        }
    }

    static public function get($id_item_menu){
        if(empty($id_item_menu)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_item_menu", $id_item_menu)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function cambiar_estado($id_item_menu, $estado){
        return self::actualizar($id_item_menu,[
            "estado" => $estado
        ]);
    }

    static public function dar_baja ($id_item_menu){
        return self::cambiar_estado($id_item_menu, 0);
    }

    static public function dar_alta ($id_item_menu){
        return self::cambiar_estado($id_item_menu, 1);
    }
}
