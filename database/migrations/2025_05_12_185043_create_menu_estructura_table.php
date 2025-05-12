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
        Schema::create('menu_estructura', function (Blueprint $table) {
            $table->integer('item', false, true)->length(6)->autoIncrement();
            $table->char('codigo', 5)->nullable();
            $table->char('usuario', 15)->nullable();
            $table->char('modulo', 15);
            $table->char('etiqueta', 20)->nullable();
            $table->char('datelle', 40)->nullable();
            $table->char('recurso', 20)->nullable();
            $table->char('padre', 5)->nullable();
            $table->char('permisos', 5)->nullable();
            $table->string('reporte', 1)->default('N');
            
            $table->primary(['item', 'modulo0']);
            $table->index('usuario', 'usuario');
            
            // No incluimos timestamps (created_at y updated_at) ya que no están en tu esquema original
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_estructura');
    }
};