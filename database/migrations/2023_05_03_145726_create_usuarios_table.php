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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_0900_ai_ci';
            $table->id();
            $table->string("nombres", 100)->nullable();
            $table->string("apellidos", 100)->nullable();
            $table->bigInteger("cedula")->nullable();
            $table->string("email", 150)->nullable();
            $table->string("pais", 100)->nullable();
            $table->string("direccion", 180)->nullable();
            $table->bigInteger("celular")->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
