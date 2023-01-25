<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'tipo_documento',
        'nombres',
        'telefono',
        'email',
        'direccion',
        'ciudad',
        'materia_id'
    ];

}
