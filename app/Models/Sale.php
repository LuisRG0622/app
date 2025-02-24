<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'product_name', 'quantity', 'price',
    ];

    /**
     * Relación con el cliente (una venta pertenece a un cliente).
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    

    

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }


}
