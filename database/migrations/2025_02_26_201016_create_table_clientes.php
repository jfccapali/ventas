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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->string('nombres',255);
            $table->string('apellido_paterno',255);
            $table->string('apellido_materno',255);
            $table->string('direccion',255);
            $table->enum('sexo',['M','F']);
            $table->date('fecha_nacimiento');
            $table->string('nombre_imagen',255)->nullable();
            $table->datetime('fecha_imagen');
            $table->string('estado','1')->default('1');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
