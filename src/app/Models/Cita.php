<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Cita extends Model
{

    //permite crear test y seeders hasfactory
    use HasFactory;
    //fillable permite la modificacion de los campos en la bd
    protected $fillable=[
        'user_id',
        'marca',
        'modelo',
        'matricula',
        'fecha',
        'hora',
        'duracion',
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id');
    }

}
