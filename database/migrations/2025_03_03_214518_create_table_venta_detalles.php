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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->bigIncrements('id_venta_detalle');
            $table->unsignedInteger('id_venta');
            $table->unsignedInteger('id_producto');
            $table->integer('cantidad')->default(0);
            $table->decimal('precio_venta',11,2)->default(0);
            $table->decimal('importe',11,2)->default(0);
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
        Schema::dropIfExists('venta_detalles');
    }
};
