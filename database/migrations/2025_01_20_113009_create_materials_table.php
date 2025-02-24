<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('precio', 10, 2);  // Asegúrate de definir el tipo de dato adecuado para el precio
            $table->text('descripcion')->nullable(); // Descripción del material (opcional)
            $table->integer('existencias')->default(0); // Cantidad de materiales disponibles
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
