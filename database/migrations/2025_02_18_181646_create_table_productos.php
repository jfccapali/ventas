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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->unsignedInteger('id_categoria');
            $table->string('nombre_producto',255);
            $table->string('descripcion',500)->nullable();
            $table->string('estado',1)->default('1');
            $table->integer('stock')->default(0);
            $table->decimal('precio',11,2)->default(0);
            $table->unique(['nombre_producto']);
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
