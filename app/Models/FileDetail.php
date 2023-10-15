<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class FileDetail extends Model
{
    protected $primaryKey = "fd_id";
    protected $table = "file_detail";
    protected $fillable = [
        'file_id',
        'fd_url',
        'fd_name',
        'fd_extension',
        'fd_size',
        'fd_status',
    ];

}
