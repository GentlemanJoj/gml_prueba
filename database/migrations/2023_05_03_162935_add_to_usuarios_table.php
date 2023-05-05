<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


/**
 * Se añade a la tabla usuarios el campo de IdCategoria 
 * y se establece como FK con la tabla categorias
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->after('celular', function ($table) {
                $table->foreignId('IdCategoria')
                    ->constrained('categorias')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        });
    }

    /**
     * En caso de regresar al estado anterior, se borra la FK 
     * y se elimina el campo
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_idcategoria_foreign');
            $table->dropColumn('IdCategoria');
        });
    }
};
