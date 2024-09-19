<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Insumo extends Model
{
    use HasFactory;
    protected $table = 'insumo';
    protected $primaryKey = 'id_insumo';

    protected $fillable = [
        'nombre_insumo',
        'descripcion',
        'stock'
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
                                insumo_datos as (
                    select
                        i.id_insumo
                        ,i.nombre_insumo
                        ,i.descripcion
                        ,i.stock
                        ,count(i.id_insumo) over() as totalrecords
                        from insumo i
                ),
               insumo_busqueda as (
                    select p.* , count(id_insumo) over() as totalrecordswithfilter
                    from insumo_datos p
                    cross join datos_input di
                    where nombre_insumo ilike  '%'||di.palabra||'%'
                ),
                insumo_paginado as (
                    select
                    *
                    from insumo_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from insumo_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_insumo, $data){
        if(empty($id_insumo) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_insumo", $id_insumo)
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
    static public function get($id_insumo){
        if(empty($id_insumo)){
            return respuesta::error("Datos no validos para la busqueda.");
        }
        $res = self::where("id_insumo", $id_insumo)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function listar_insumo (){
        return DB::select(
            DB::raw("
           SELECT
                    i.id_insumo
                    , i.nombre_insumo
                FROM insumo i
            "),
            [ ]
        );
    }
}
