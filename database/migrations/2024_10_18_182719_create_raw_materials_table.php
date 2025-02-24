<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('code');            // Código del material
            $table->string('name');            // Nombre del material
            $table->string('image');           // Imagen del material (nombre del archivo o ruta)
            $table->text('description');       // Descripción del material
            $table->string('lot');             // Lote del material
            $table->float('dimension1');       // Primera dimensión (número flotante)
            $table->float('dimension2');       // Segunda dimensión (número flotante)
            $table->string('unit');            // Unidad de medida (pulgadas o milímetros)
            $table->unsignedBigInteger('supplier_id'); // ID del proveedor (relación con la tabla de proveedores)
            $table->integer('quantity');       // Cantidad de piezas
            $table->float('unit_cost');        // Costo por unidad
            $table->float('total_cost');       // Costo total
            $table->timestamps();

            // Clave foránea para la relación con proveedores
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials');
    }
}
