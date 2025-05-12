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
        Schema::table('users', function (Blueprint $table) {
            // Agregar el campo 'user'
            $table->string('user')->after('id');
            
            // Eliminar el índice único existente en email
            $table->dropUnique('users_email_unique');
            
            // Crear un índice único compuesto para user y email
            $table->unique(['user', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar el índice único compuesto
            $table->dropUnique(['user', 'email']);
            
            // Restaurar el índice único en email
            $table->unique('email');
            
            // Eliminar el campo 'user'
            $table->dropColumn('user');
        });
    }
};