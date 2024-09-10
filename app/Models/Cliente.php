<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'id_tipo_cliente',
        'nombre_cliente',
        'genero',
        'edad',
        'telefono',
        'estado ',
        'password'
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
              			cliente_datos as (
                    select
                        c.id_cliente
                        ,tp.nombre_tipo
                        ,c.nombre_cliente
                        ,c.genero
                        ,c.edad
                        ,c.telefono
                        ,c.estado
                        ,count(c.id_cliente) over() as totalrecords
                        from cliente c
                        JOIN tipo_cliente tp ON c.id_tipo_cliente = tp.id_tipo_cliente
                ),
                cliente_busqueda as (
                    select p.* , count(id_cliente) over() as totalrecordswithfilter
                    from cliente_datos p
                    cross join datos_input di
                    where nombre_cliente ilike  '%'||di.palabra||'%'
                    or estado ilike  '%'||di.palabra||'%'
                ),
                cliente_paginado as (
                    select
                    *
                    from cliente_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from cliente_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_cliente, $data){
        if(empty($id_cliente) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_cliente", $id_cliente)
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

    static public function get($id_cliente){
        if(empty($id_cliente)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_cliente", $id_cliente)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function cambiar_estado($id_cliente, $estado){
        return self::actualizar($id_cliente,[
            "estado " => $estado
        ]);
    }

    static public function dar_baja ($id_cliente){
        return self::cambiar_estado($id_cliente, 0);
    }

    static public function dar_alta ($id_cliente){
        return self::cambiar_estado($id_cliente, 1);
    }
}
