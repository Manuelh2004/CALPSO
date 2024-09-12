<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursal';
    protected $primaryKey = 'id_sucursal';

    protected $fillable = [
        'id_distrito',
        'direccion',
        'telefono',
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
              						sucursal_datos as (
					select
                        s.id_sucursal
                        ,ds.nombre_distrito
                        ,s.direccion
                        ,s.telefono
                        ,s.estado
                        ,count(s.id_sucursal) over() as totalrecords
                        from sucursal s
                        JOIN distrito_sucursal ds ON ds.id_distrito = s.id_distrito
                ),
                sucursal_busqueda as (
                    select p.* , count(id_sucursal) over() as totalrecordswithfilter
                    from sucursal_datos p
                    cross join datos_input di
                    where nombre_distrito ilike  '%'||di.palabra||'%'
                ),
                sucursal_paginado as (
                    select
                    *
                    from sucursal_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from sucursal_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_sucursal, $data){
        if(empty($id_sucursal) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_sucursal", $id_sucursal)
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

    static public function get($id_sucursal){
        if(empty($id_sucursal)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_sucursal", $id_sucursal)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function cambiar_estado($id_sucursal, $estado){
        return self::actualizar($id_sucursal,[
            "estado" => $estado
        ]);
    }

    static public function dar_baja ($id_sucursal){
        return self::cambiar_estado($id_sucursal, 0);
    }

    static public function dar_alta ($id_sucursal){
        return self::cambiar_estado($id_sucursal, 1);
    }

}
