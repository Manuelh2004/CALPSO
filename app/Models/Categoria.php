<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre_categoria'
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
                                categoria_datos as (
                    select
                        c.id_categoria
                        ,c.nombre_categoria
                        ,count(c.id_categoria) over() as totalrecords
                        from categoria c
                ),
                categoria_busqueda as (
                    select p.* , count(id_categoria) over() as totalrecordswithfilter
                    from categoria_datos p
                    cross join datos_input di
                    where nombre_categoria ilike  '%'||di.palabra||'%'
                ),
                categoria_paginado as (
                    select
                    *
                    from categoria_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from categoria_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_categoria, $data){
        if(empty($id_categoria) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }
        $res = self::where("id_categoria", $id_categoria)
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
    static public function get($id_categoria){
        if(empty($id_categoria)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_categoria", operator: $id_categoria)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function listar_categoria (){
        return DB::select(
            DB::raw("
              SELECT
                    c.id_categoria
                    , c.nombre_categoria
                FROM categoria c
            "),
            [ ]
        );
    }
}
