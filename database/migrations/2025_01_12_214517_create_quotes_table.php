<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('work')->nullable();
            $table->string('width')->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('length_price', 10, 2)->nullable();
            $table->json('lighting')->nullable();
            $table->json('lighting_price')->nullable();
            $table->json('connection')->nullable();
            $table->json('connection_price')->nullable();
            $table->json('gas')->nullable();
            $table->json('gas_price')->nullable();
            $table->json('cga_v5')->nullable();
            $table->json('cga_v5_price')->nullable();
            $table->json('brands')->nullable();
            $table->json('brand_price')->nullable();
            $table->json('accessories')->nullable();
            $table->json('accessory_price')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->integer('discount');
            $table->integer('profit_margin');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
