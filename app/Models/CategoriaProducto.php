<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers;

class CategoriaProducto extends Model
{
    protected $fillable = [
        'codigo_exterior',
        'codigo_interior',
        'nombre',
        'existencias',
        'diametro_mm',
        'diametro_in',
        'diametro_mm_2',
        'proveedor_id',
        'precio',
        'producto_id',
        'imagen_productos',
        'nombre_productos'
    ];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Supplier::class, 'proveedor_id');
    }
}


