<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;


class MetodoPago extends Model
{
    protected $table = 'metodo_pago';

    
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
                metodo_pago_datos as (
                    select
                        m.id_metodo_pago
                        ,m.nombre_metodo_pago
                        ,m.descripcion
                        ,count(m.id_metodo_pago) over() as totalrecords
                    from metodo_pago m
                ),
                metodo_pago_busqueda as (
                    select m.* , count(id_metodo_pago) over() as totalrecordswithfilter
                    from metodo_pago_datos m
                    cross join datos_input di
                    where nombre_metodo_pago ilike '%'||di.palabra||'%'
                ),
                metodo_pago_paginado as (
                    select
                    *
                    from metodo_pago_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from metodo_pago_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=>$start, "rowperpage"=>$rowperpage]
        );
    }

    
    static public function actualizar($id_metodo_pago, $data)
    {
        if(empty($id_metodo_pago) || empty($data)){
            return respuesta::error("Datos no válidos para realizar el cambio de información.");
        }

        $res = self::where("id_metodo_pago", $id_metodo_pago)
                ->update($data);

        return $res ? respuesta::ok() : respuesta::error("No se ha logrado hacer el cambio de información.");
    }

    
    static public function crear($data)
    {
        $res = self::create($data);
        return $res ? respuesta::ok($res) : respuesta::error("No se ha podido registrar");
    }

    
    static public function get($id_metodo_pago)
    {
        $res = self::where("id_metodo_pago", $id_metodo_pago)->first();
        return $res ? respuesta::ok($res) : respuesta::error("No se ha encontrado data relacionada.");
    }
}
