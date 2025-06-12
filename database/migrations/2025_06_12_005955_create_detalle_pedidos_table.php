<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->foreignId('id_pedido')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('detalle_pedidos');
    }
};
