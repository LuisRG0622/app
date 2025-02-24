<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SalesController;

class Quote extends Model
{
    protected $fillable = [
        'client_id', 'work', 'width', 'length', 'length_price',
        'lighting', 'lighting_price', 'connection', 'connection_price',
        'gas', 'gas_price', 'cga_v5', 'cga_v5_price',
        'brands', 'brand_price', 'accessories', 'accessory_price',
        'subtotal', 'iva', 'discount', 'profit_margin', 'total'
    ];

    protected $casts = [
        'lighting' => 'array',
        'lighting_price' => 'array',
        'connection' => 'array',
        'connection_price' => 'array',
        'gas' => 'array',
        'gas_price' => 'array',
        'cga_v5' => 'array',
        'cga_v5_price' => 'array',
        'brands' => 'array',
        'brand_price' => 'array',
        'accessories' => 'array',
        'accessory_price' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Quote.php
    public function materials()
    {
        return $this->belongsToMany(CategoriaProducto::class, 'quote_material', 'quote_id', 'material_id');
    }

 


}

