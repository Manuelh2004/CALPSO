<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class SenderBlock extends Model
{
    protected $primaryKey = "sb_id";
    protected $table = "sender_block";

    protected $fillable = [
        'block_id',
        'sender_id',
        'sb_date_start',
        'sb_date_finish',
        'sb_status',
    ];

}
