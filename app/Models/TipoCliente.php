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
    protected $primaryKey = 'Id_TipoCliente';

    protected $fillable = [
        'NombreTipo',
        'Descripcion',
        'DescuentoAsociado'
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
                horario_datos as (
                    select
					p.horario_id
					,CONCAT(pe.persona_nombre,' ',pe.persona_apellido_paterno, ' ', pe.persona_apellido_materno) as nombre_completo
					,p.horario_lunes
					,p.horario_martes
					,p.horario_miercoles
					,p.horario_jueves
					,p.horario_viernes
					,p.horario_sabado
					,p.horario_domingo
					,p.horario_estado
					,count(p.horario_id) over() as totalrecords
					from horario p
					JOIN persona pe ON p.usuario_id = pe.usuario_id -- La condición de unión
                ),
                horario_busqueda as (
                    select p.* , count(horario_id) over() as totalrecordswithfilter
                    from horario_datos p
                    cross join datos_input di
                    where nombre_completo ilike  '%'||di.palabra||'%'
                ),
                horario_paginado as (
                    select
                    *
                    from horario_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from horario_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($Id_TipoCliente, $data){
        if(empty($Id_TipoCliente) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("Id_TipoCliente", $Id_TipoCliente)
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

    static public function get($Id_TipoCliente){
        if(empty($Id_TipoCliente)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("Id_TipoCliente", $Id_TipoCliente)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }



}
