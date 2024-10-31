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

    protected $table = 'usuario';
    protected $primaryKey = 'usuario_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'usuario_fecha_expiracion',
        'usuario_login_intentos',
        'psis_rol_usuario',
        'id_area',
        'id_cargo',
        'id_tipo',
        'id_sucursal',
        'nombre_empleado',
        'edad',
        'correo_electronico',
        'genero',
        'estado'
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
              	usuario_datos as (
				    select
				        u.usuario_id,
				        u.nombre_empleado,
				        u.name,
				        u.password,
				        u.estado,
				        count(u.usuario_id) over() as totalrecords
				    from usuario u
				),
                usuario_busqueda as (
                    select p.* , count(usuario_id) over() as totalrecordswithfilter
                    from usuario_datos p
                    cross join datos_input di
                    where nombre_empleado ilike  '%'||di.palabra||'%'
                ),
                usuario_paginado as (
                    select
                    *
                    from usuario_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from usuario_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function get($usuario_id){
        if(empty($usuario_id)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("usuario_id", $usuario_id)
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

    static public function actualizar($usuario_id, $data){
        if(empty($usuario_id) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("usuario_id", $usuario_id)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }

}
