<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class WebhookHistorical extends Model
{
    protected $primaryKey = "wh_id";
    protected $table = "webhook_historical";
    protected $fillable = [
        'wr_id',
        'sr_id',
        'sender_id',
        'wh_http_status',
        'wh_http_response',
        'wh_status',
    ];
    
}
