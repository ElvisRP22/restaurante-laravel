<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_estados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_estado');
            $table->timestamp('fecha_registro');
            $table->timestamps();

            $table->primary(['id_pedido', 'id_estado']);
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_estados');
    }
};
