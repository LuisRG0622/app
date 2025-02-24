<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categoria_productos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    
        Schema::table('productos', function (Blueprint $table) {
            $table->foreignId('categoria_id')->constrained('categoria_productos')->onDelete('cascade');
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('categoria_productos');
    }
};