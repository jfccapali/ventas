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
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id_venta');
            $table->unsignedInteger('id_cliente');
            $table->unsignedInteger('id_vendedor');
            $table->decimal('importe_venta',11,2)->default(0);
            $table->decimal('importe_pagado',11,2)->default(0);
            $table->decimal('importe_deuda',11,2)->default(0);
            $table->string('estado_transaccion',1)->default('G');
            $table->string('estado',1)->default('1');
            $table->integer('usuario_creacion');
            $table->datetime('fecha_creacion');
            $table->integer('usuario_modificacion');
            $table->datetime('fecha_modificacion');
            $table->integer('usuario_eliminacion');
            $table->datetime('fecha_eliminacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
