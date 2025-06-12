<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('medios_de_pagos', function (Blueprint $table) {
            $table->id('id_medio_pago');
            $table->string('metodo');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('medios_de_pagos');
    }
};
