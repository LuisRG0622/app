<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no es el plural del nombre del modelo
    // protected $table = 'materials';

    // Campos que son asignables en masa
    protected $fillable = [
        'name',  // Nombre del material
        'precio', // Precio del material
        'descripcion', // Descripción del material
        'existencias', // Cantidad disponible en stock
    ];
}
