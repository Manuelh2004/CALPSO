<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class File extends Model
{
    protected $primaryKey = "file_id";
    protected $table = "files";

    protected $fillable = [
        'file_status',
    ];

}
