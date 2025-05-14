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
        Schema::create('deptos', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nombre', 30)->nullable();
            $table->string('resumido', 12)->nullable();
            $table->integer('iva')->nullable();
            $table->string('icono', 100)->nullable();
            $table->integer('orden')->default(0);
            $table->boolean('visible')->default(true);
            $table->boolean('lMesas')->default(true);
            $table->boolean('lMostrador')->default(true);
            $table->boolean('lPOS')->default(true);
            $table->boolean('lDelivery')->default(true);
            $table->boolean('lWeb')->default(true);
            $table->boolean('lCarDig')->default(true);
            $table->decimal('descuento', 5, 2)->default(0.00);
            $table->boolean('lVendido')->default(false);
            $table->boolean('lPromo')->default(false);
            $table->boolean('lNuevo')->default(false);
            $table->boolean('lVegetariano')->default(false);
            $table->boolean('lTacc')->default(false);
            $table->boolean('lVegano')->default(false);
            $table->boolean('lLactosa')->default(false);
            $table->boolean('lKosher')->default(false);
            $table->boolean('lFrutos')->default(false);
            $table->integer('cantidad_iconos')->default(0);
            
            // Índices
            $table->index(['orden', 'lMesas']);
            $table->index(['orden', 'lDelivery']);
            $table->index(['orden', 'lMostrador']);
            
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptos');
    }
};