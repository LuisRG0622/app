<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen', 'id_tipo'];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'nombre_tipo');
    }

    public function categorias()
    {
        return $this->belongsTo(CategoriaProducto::class, 'categoria_id');
    }

    public function imagen()
    {
        return $this->attributes['imagen'] ?? 'default.jpg'; // Imagen por defecto si falta
    }

}

