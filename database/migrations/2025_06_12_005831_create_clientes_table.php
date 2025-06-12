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
    Schema::create('clientes', function (Blueprint $table) {
        $table->bigIncrements('id_cliente');
        $table->string('nombre');
        $table->unsignedBigInteger('id_mesa')->nullable();
        $table->string('pedido')->nullable();
        $table->unsignedBigInteger('id_estado')->nullable();
        $table->decimal('total', 8, 2)->default(0);
        $table->timestamps();

        $table->foreign('id_mesa')->references('id_mesa')->on('mesas')->onDelete('set null');
        $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('set null');
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
