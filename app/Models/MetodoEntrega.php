<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

class MetodoEntrega extends Model
{
    use HasFactory;
    protected $table = 'metodo_entrega';
    protected $primaryKey = 'id_metodo_entrega';

    protected $fillable = [
        'nombre_metodo_entrega',
        'costo',
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
                metodo_entrega_datos as (
                        select
                            me.id_metodo_entrega
                            ,me.nombre_metodo_entrega
                            ,me.costo
                            ,count(me.id_metodo_entrega) over() as totalrecords
                            from metodo_entrega me
                    ),
                    metodo_entrega_busqueda as (
                        select p.* , count(id_metodo_entrega) over() as totalrecordswithfilter
                        from metodo_entrega_datos p
                        cross join datos_input di
                        where nombre_metodo_entrega ilike  '%'||di.palabra||'%'
                    ),
                    metodo_entrega_paginado as (
                        select
                        *
                        from metodo_entrega_busqueda
                        order by ".$columnName." ".$columnSortOrder."
                        offset (select start from datos_input)
                        limit (select rowperpage from datos_input)
                    )
                    select * from metodo_entrega_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_metodo_entrega, $data){
        if(empty($id_metodo_entrega) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }
        $res = self::where("id_metodo_entrega", $id_metodo_entrega)
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
    static public function get($id_metodo_entrega){
        if(empty($id_metodo_entrega)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_metodo_entrega", $id_metodo_entrega)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
}
