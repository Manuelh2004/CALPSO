<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $table = 'user_table';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'user_state',
        'user_email',
        'expiration_date',
        'user_creator',
        'psis_user_role',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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
                user_datos as (
                    select
					u.user_id
					,u.name
					,u.user_status
					,u.user_email
					,u.psis_user_role
					,count(u.user_id) over() as totalrecords
					from user_table u
                ),
                user_busqueda as (
                    select u.* , count(user_id) over() as totalrecordswithfilter
                    from user_datos u
                    cross join datos_input di
                    where name ilike  '%'||di.palabra||'%'
                    or user_email ilike  '%'||di.palabra||'%'
                ),
                user_paginado as (
                    select
                    *
                    from user_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from user_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function get($user_id){
        if(empty($user_id)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("user_id", $user_id)
                ->first();
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
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

    static public function cambiar_estado($user_id, $estado){
        

        return self::actualizar($user_id,[
            "user_status" => $estado
        ]);
    }

    static public function dar_baja ($user_id){
        return self::cambiar_estado($user_id, 0);
    }

    static public function dar_alta ($user_id){
        return self::cambiar_estado($user_id, 1);
    }

    static public function actualizar($user_id, $data){
        if(empty($user_id) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("user_id", $user_id)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }

}
