<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class DistritoSucursal extends Model
{
    use HasFactory;
    protected $table = 'distrito_sucursal';
    protected $primaryKey = 'id_distrito';

    protected $fillable = [
        'nombre_distrito'
    ];
    static public function listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage)
{
    // Ajustar valores de paginación
    $rowperpage = $rowperpage < 0 ? null : $rowperpage;

    // Realizar la consulta
    return DB::select(
        DB::raw("
            WITH datos_input AS (
            SELECT
                :skip AS start,
                :rowperpage AS rowperpage,
                :searchvalue AS palabra
        ),
        distrito_sucursal_datos AS (
            SELECT
                ds.id_distrito,
                ds.nombre_distrito,
                COUNT(ds.id_distrito) OVER() AS totalrecords
            FROM
                distrito_sucursal ds
        ),
        distrito_sucursal_busqueda AS (
            SELECT
                p.*,
                (
                    SELECT
                        COUNT(*)
                    FROM
                        distrito_sucursal_datos
                    WHERE
                        nombre_distrito LIKE CONCAT('%', di.palabra, '%')
                ) AS totalrecordswithfilter
            FROM
                distrito_sucursal_datos p
                CROSS JOIN datos_input di
            WHERE
                p.nombre_distrito LIKE CONCAT('%', di.palabra, '%')
        )
        SELECT *
        FROM distrito_sucursal_busqueda
        ORDER BY id_distrito DESC
        LIMIT :rowperpage OFFSET :skip;

        "),
        [
            "searchvalue" => $searchValue,
            "start" => $start,
            "rowperpage" => $rowperpage
        ]
    );
}


    static public function actualizar($id_distrito, $data){
        if(empty($id_distrito) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_distrito", $id_distrito)
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

    static public function get($id_distrito){
        if(empty($id_distrito)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_distrito", $id_distrito)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function listar_distrito(){
        return DB::select(
            DB::raw("
          SELECT
                    ds.id_distrito
                    , ds.nombre_distrito
                FROM distrito_sucursal ds
            "),
            [ ]
        );
    }


}
