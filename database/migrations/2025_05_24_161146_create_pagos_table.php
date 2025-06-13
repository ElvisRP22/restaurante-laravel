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
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id_pago');
            $table->string('descripcion', 30);
            $table->decimal('monto', 8, 2);
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_medio_pago');
            $table->timestamps();
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_medio_pago')->references('id_medio_pago')->on('medios_de_pago')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
