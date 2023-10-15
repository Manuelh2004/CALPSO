<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class SenderType extends Model
{
    protected $primaryKey = "st_id";
    protected $table = "sender_type";
    protected $fillable = [
        'st_name',
        'st_model',
        'st_brand',
        'st_codename',
        'st_status',
    ];


}
