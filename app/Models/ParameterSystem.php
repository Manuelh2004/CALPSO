<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

class ParameterSystem extends Model
{
    use HasFactory;

    protected $primaryKey = "psis_code";
    protected $table = "parameter_system";

    protected $fillable = ['psis_type_code', 'psis_value', 'psis_order', 'user_creator_id', 'psis_status'];


    static public function list_byType($psis_type_code){
        if(empty($psis_type_code)){
            return [];
        }
        
        $res = DB::select( 
            DB::raw("
                select 
                    psis_code
                    , psis_type_code
                    , psis_value
                    , psis_order
                from  parameter_system ps
                where ps.psis_type_code = :psis_type_code
                and ps.psis_status = 1
                order by ps.psis_order asc
            "),
            ["psis_type_code" => $psis_type_code ]
        );

        if(isset($res)){
            return $res;
        } else {
            return [];
        }
    }

    static public function list_byType2 ($psis_type_code){
        $res = self::where("psis_type_code", $psis_type_code)
                ->get();

        if(isset($res)){
            return $res;
        } else {
            return [];
        }
    }
}
