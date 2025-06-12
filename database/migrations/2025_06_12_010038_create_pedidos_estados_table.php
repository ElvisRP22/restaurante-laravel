<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pedidos_estados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pedido')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('id_estado')->constrained('estados')->onDelete('cascade');
            $table->timestamp('fecha_cambio')->useCurrent();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pedidos_estados');
    }
};
