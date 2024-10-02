<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class detalle_entrega extends Model
{
    use HasFactory;

    protected $table = 'detalle_entrega';
    protected $fillable = [
        'id_metodo_entrega', 
        'direccion_entrega', 
        'estado_entrega', 
        'comentario', 
        'fecha', 
        'hora'
    ];

    static public function listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage)
    {
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
                detalle_entrega_datos as (
                    select
                        d.id_detalle_entrega
                        ,d.id_metodo_entrega
                        ,d.direccion_entrega
                        ,d.estado_entrega
                        ,d.comentario
                        ,d.fecha
                        ,d.hora
                        ,count(d.id_detalle_entrega) over() as totalrecords
                    from detalle_entrega d
                ),
                detalle_entrega_busqueda as (
                    select d.* , count(id_detalle_entrega) over() as totalrecordswithfilter
                    from detalle_entrega_datos d
                    cross join datos_input di
                    where direccion_entrega ilike '%'||di.palabra||'%'
                ),
                detalle_entrega_paginado as (
                    select
                    *
                    from detalle_entrega_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from detalle_entrega_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=>$start, "rowperpage"=>$rowperpage]
        );
    }

    static public function actualizar($id_detalle_entrega, $data)
    {
        if(empty($id_detalle_entrega) || empty($data)){
            return respuesta::error("Datos no válidos para realizar el cambio de información.");
        }

        $res = self::where("id_detalle_entrega", $id_detalle_entrega)
                ->update($data);

        return $res ? respuesta::ok() : respuesta::error("No se ha logrado hacer el cambio de información.");
    }

    static public function crear($data)
    {
        $res = self::create($data);
        return $res ? respuesta::ok($res) : respuesta::error("No se ha podido registrar.");
    }

    static public function get($id_detalle_entrega)
    {
        $res = self::where("id_detalle_entrega", $id_detalle_entrega)->first();
        return $res ? respuesta::ok($res) : respuesta::error("No se ha encontrado data relacionada.");
    }
}
