<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class Person extends Model
{

    protected $table = 'person';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'user_id',
        'psis_document_type',
        'document_number',
        'person_name',
        'person_profile_name',
        'person_lastname',
        'person_phone',
        'person_email',
        'person_birth_date',
        'person_address',
        'file_id',
        'creator_user_person',
        'person_status',
    ];

}
