<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class InsumoItem extends Model
{
    use HasFactory;
    protected $table = 'insumo_item';
    protected $primaryKey = 'id_insumo_item';

    protected $fillable = [
        'id_item_menu',
        'id_insumo',
        'cantidad'
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
              		              			insumo_item_datos as (
                    select
                        i.id_insumo_item
                        ,im.nombre_item
						,imo.nombre_insumo
                        ,i.cantidad
                        ,count(i.id_insumo_item) over() as totalrecords
                        from insumo_item i
                        JOIN insumo imo ON i.id_insumo = imo.id_insumo
						JOIN item_menu im ON im.id_item_menu = i.id_item_menu
                ),
                insumo_item_busqueda as (
                    select p.* , count(id_insumo_item) over() as totalrecordswithfilter
                    from insumo_item_datos p
                    cross join datos_input di
                    where nombre_item ilike  '%'||di.palabra||'%'
                ),
                insumo_item_paginado as (
                    select
                    *
                    from insumo_item_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from insumo_item_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_insumo_item, $data){
        if(empty($id_insumo_item) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_insumo_item", $id_insumo_item)
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
    static public function get($id_insumo_item){
        if(empty($id_insumo_item)){
            return respuesta::error("Datos no validos para la busqueda.");
        }
        $res = self::where("id_insumo_item", $id_insumo_item)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
}
