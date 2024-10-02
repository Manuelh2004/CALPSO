<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class tipo_comprobante extends Model
{
    use HasFactory;

    protected $table = 'tipo_comprobante';
    protected $fillable = [
        'nombre_comprobante', 
        'descripcion'
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
                tipo_comprobante_datos as (
                    select
                        t.id_tipo_comprobante
                        ,t.nombre_comprobante
                        ,t.descripcion
                        ,count(t.id_tipo_comprobante) over() as totalrecords
                    from tipo_comprobante t
                ),
                tipo_comprobante_busqueda as (
                    select t.* , count(id_tipo_comprobante) over() as totalrecordswithfilter
                    from tipo_comprobante_datos t
                    cross join datos_input di
                    where nombre_comprobante ilike '%'||di.palabra||'%'
                ),
                tipo_comprobante_paginado as (
                    select
                    *
                    from tipo_comprobante_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from tipo_comprobante_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=>$start, "rowperpage"=>$rowperpage]
        );
    }

    static public function actualizar($id_tipo_comprobante, $data)
    {
        if(empty($id_tipo_comprobante) || empty($data)){
            return respuesta::error("Datos no válidos para realizar el cambio de información.");
        }

        $res = self::where("id_tipo_comprobante", $id_tipo_comprobante)
                ->update($data);

        return $res ? respuesta::ok() : respuesta::error("No se ha logrado hacer el cambio de información.");
    }

    static public function crear($data)
    {
        $res = self::create($data);
        return $res ? respuesta::ok($res) : respuesta::error("No se ha podido registrar.");
    }

    static public function get($id_tipo_comprobante)
    {
        $res = self::where("id_tipo_comprobante", $id_tipo_comprobante)->first();
        return $res ? respuesta::ok($res) : respuesta::error("No se ha encontrado data relacionada.");
    }
}
