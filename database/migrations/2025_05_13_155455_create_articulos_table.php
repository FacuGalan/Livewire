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
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('codigo');
            $table->bigInteger('codbar')->default(0);
            $table->string('nombre', 30)->nullable();
            $table->string('resumido', 10)->nullable();
            $table->integer('depto')->default(1);
            $table->integer('iva')->default(1);
            $table->boolean('lstock')->default(false);
            $table->integer('stock')->default(0);
            $table->decimal('precossiva', 10, 2)->default(0.00);
            $table->decimal('porcentaje', 5, 2)->default(0.00);
            $table->decimal('precio', 10, 2)->default(0.00);
            $table->integer('sabores')->default(0);
            $table->boolean('lsabores')->default(false);
            $table->boolean('lstockR')->default(false);
            $table->decimal('preciocos', 10, 2)->default(0.00);
            $table->decimal('merma', 5, 2)->default(0.00);
            $table->decimal('misela', 5, 2)->default(0.00);
            $table->boolean('para_delivery')->default(true);
            $table->boolean('visible')->default(true);
            $table->boolean('activo')->default(true);
            $table->integer('orden')->default(0);
            $table->boolean('destacado')->default(true);
            $table->boolean('solo_consulta')->default(true);
            $table->text('observa_web')->nullable();
            $table->integer('tiempo_prod')->default(0);
            $table->boolean('pesable')->default(false);
            $table->decimal('porcentajew', 5, 2)->default(0.00);
            $table->decimal('preciow', 10, 2)->default(0.00);
            $table->boolean('para_carta')->default(true);
            $table->boolean('agotado')->default(false);
            $table->decimal('stockmin', 10, 2)->default(0.00);
            $table->decimal('porcentaje_m', 5, 2)->default(0.00);
            $table->decimal('precio_m', 10, 2)->default(0.00);
            $table->boolean('solo_efectivo')->default(false);
            $table->boolean('inactivo')->default(false);
            $table->boolean('solo_unitario')->default(false);
            $table->boolean('lMesas')->default(true);
            $table->boolean('lMostrador')->default(true);
            $table->boolean('lPOS')->default(true);
            $table->boolean('lDelivery')->default(true);
            $table->boolean('solo_takeaway')->default(false);
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
            $table->boolean('solo_digital')->default(false);
            $table->decimal('precio_oferta', 10, 2)->default(0.00);
            $table->decimal('preciow_oferta', 10, 2)->default(0.00);
            $table->decimal('porc_descuentow', 5, 2)->default(0.00);
            $table->decimal('preciocd_oferta', 10, 2)->default(0.00);
            $table->decimal('preciow_oferta2', 10, 2)->default(0.00);
            $table->decimal('porc_descuento', 5, 2)->default(0.00);
            $table->text('alergenos')->nullable();
            $table->decimal('preciom_oferta', 10, 2)->default(0.00);
            $table->integer('orden_local')->default(0);
            $table->integer('descuenta_de')->default(0);
            $table->decimal('descuenta_de_cant', 5, 2)->default(0.00);
            $table->boolean('lCanjea_puntos')->default(false);
            $table->integer('puntos')->default(0);
            $table->decimal('comision', 5, 2)->default(0.00);
            
            // Índices
            $table->index(['codigo', 'inactivo']);
            $table->index(['codbar', 'inactivo']);
            $table->index('depto');
            $table->index('codigo');
            $table->index('lstockR');
            
            // Clave foránea
            $table->foreign('depto')->references('codigo')->on('deptos')->name('Deptos');
            
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};