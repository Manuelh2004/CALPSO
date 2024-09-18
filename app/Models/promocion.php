<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;


class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promocion';
    protected $primaryKey = 'id_promocion';

    protected $fillable = [
        'nombre_promocion',
        'descripcion_promocion',
        'fecha_inicio',
        'fecha_fin',
        'estado_promocion'
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
                    promocion_datos as (
                        select
                            p.id_promocion
                            ,p.nombre_promocion
                            ,p.descripcion_promocion
                            ,p.fecha_inicio
                            ,p.fecha_fin
                            ,p.estado_promocion
                            ,count(p.id_promocion) over() as totalrecords
                        from promocion p
                    ),
                    promocion_busqueda as (
                        select p.* , count(id_promocion) over() as totalrecordswithfilter
                        from promocion_datos p
                        cross join datos_input di
                        where nombre_promocion ilike '%'||di.palabra||'%'
                    ),
                    promocion_paginado as (
                        select
                        *
                        from promocion_busqueda
                        order by ".$columnName." ".$columnSortOrder."
                        offset (select start from datos_input)
                        limit (select rowperpage from datos_input)
                    )
                select * from promocion_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    
    static public function actualizar($id_promocion, $data){
        if(empty($id_promocion) || empty($data)){
            return respuesta::error("Datos no válidos para realizar el cambio de información.");
        }
    
        $res = self::where("id_promocion", $id_promocion)
                ->update($data);
    
        if($res){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de información.");
        }
    }
    
    static public function crear($data){
        $res = self::create($data);
        if($res){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha podido registrar.");
        }
    }
    
    static public function get($id_promocion){
        if(empty($id_promocion)){
            return respuesta::error("Datos no válidos para la búsqueda.");
        }
    
        $res = self::where("id_promocion", $id_promocion)
                ->first();
    
        if($res){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    
}
