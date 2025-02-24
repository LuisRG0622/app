<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Tabla relacionada
    protected $table = 'clients';

    // Laravel asume que la clave primaria es 'id', no necesitas especificarla.
    // Si llegaste a especificarla antes, elimínala para usar el valor por defecto.

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'rfc'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
