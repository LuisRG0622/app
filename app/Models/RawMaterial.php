<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinishedProduct;

class RawMaterial extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos se llama diferente, define el nombre de la tabla
    protected $table = 'raw_materials';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'code',         // Código del material
        'name',         // Nombre del material
        'image',        // Imagen del material
        'description',  // Descripción del material
        'lot',          // Lote
        'dimension1',   // Primera dimensión
        'dimension2',   // Segunda dimensión
        'unit',         // Unidad de medida (pulgadas o milímetros)
        'supplier_id',  // ID del proveedor
        'quantity',     // Cantidad de piezas
        'unit_cost',    // Costo por unidad
        'total_cost',   // Costo total
    ];

    // Relación con el modelo Supplier (Proveedor)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
