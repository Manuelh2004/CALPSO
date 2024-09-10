<?php

namespace App\Models;

use App\Http\Controllers\respuesta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoCliente extends Model
{
    use HasFactory;
    protected $table = 'tipo_cliente';
    protected $primaryKey = 'id_tipo_cliente';

    protected $fillable = [
        'nombre_tipo',
        'descripcion',
        'descuento_asociado'
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
                tipo_cliente_datos as (
                    select
                        tp.id_tipo_cliente
                        ,tp.nombre_tipo
                        ,tp.descripcion
                        ,tp.descuento_asociado
                        ,count(tp.id_tipo_cliente) over() as totalrecords
                        from tipo_cliente tp
                ),
                tipo_cliente_busqueda as (
                    select p.* , count(id_tipo_cliente) over() as totalrecordswithfilter
                    from tipo_cliente_datos p
                    cross join datos_input di
                    where nombre_tipo ilike  '%'||di.palabra||'%'
                ),
                tipo_cliente_paginado as (
                    select
                    *
                    from tipo_cliente_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from tipo_cliente_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_tipo_cliente, $data){
        if(empty($id_tipo_cliente) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_tipo_cliente", $id_tipo_cliente)
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

    static public function get($id_tipo_cliente){
        if(empty($id_tipo_cliente)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_tipo_cliente", $id_tipo_cliente)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }



}
