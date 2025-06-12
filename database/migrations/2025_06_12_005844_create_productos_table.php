<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio', 8, 2);
            $table->string('imagen');
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('productos');
    }
};
