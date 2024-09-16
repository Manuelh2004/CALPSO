<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Orden extends Model
{
    protected $table = 'ordenes';
    protected $primaryKey = 'id_orden';
    protected $fillable = ['id_cliente', 'id_sucursal', 'empleado', 'fecha_orden', 'total_orden'];
    
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
}
