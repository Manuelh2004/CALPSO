<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class UserBlock extends Model
{
    protected $primaryKey = "ub_id";
    protected $table = "user_block";
    protected $fillable = [
        'user_id',
        'block_id',
        'psis_ub_role',
        'ub_notification_status',
        'ub_codename',
        'ub_status',
    ];

}

