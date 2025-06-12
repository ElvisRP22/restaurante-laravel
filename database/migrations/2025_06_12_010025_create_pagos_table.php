<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->foreignId('id_pedido')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('id_medio_pago')->constrained('medios_de_pagos')->onDelete('cascade');
            $table->decimal('monto', 8, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pagos');
    }
};
