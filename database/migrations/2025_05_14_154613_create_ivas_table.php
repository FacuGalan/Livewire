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
        Schema::create('ivas', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nombre', 25);
            $table->decimal('tasa', 6, 2);
            $table->timestamps();
            
            $table->index('codigo', 'idx_ivas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ivas');
    }
};