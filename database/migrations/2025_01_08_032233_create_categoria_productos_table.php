<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categoria_productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_exterior');
            $table->string('codigo_interior');
            $table->string('nombre');
            $table->integer('existencias');
            $table->decimal('diametro_mm', 8, 2);
            $table->decimal('diametro_in', 8, 2);
            $table->decimal('diametro_mm_2', 8, 2);
            $table->foreignId('proveedor_id')->constrained('suppliers')->onDelete('cascade');
            $table->decimal('precio', 8, 2);
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_productos');
    }
};
