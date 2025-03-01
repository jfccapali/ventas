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
            $table->increments('id_usuario');
            $table->string('usuario',50);
            $table->string('contrasena',255);
            $table->string('nombres',255);
            $table->string('apellido_paterno',255);
            $table->string('apellido_materno',255);
            $table->string('direccion',255);
            $table->enum('sexo',['M','F']);
            $table->date('fecha_nacimiento');
            $table->string('nombre_imagen',255)->nullable();
            $table->datetime('fecha_imagen')->nullable();
            $table->string('remember_token',100)->nullable();
            $table->string('estado',1)->default('1');
            $table->unique(['usuario']);
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
