<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::create(['name' => 'Proveedor 1', 'contact_info' => 'info@proveedor1.com']);
        Supplier::create(['name' => 'Proveedor 2', 'contact_info' => 'info@proveedor2.com']);
    }
}

