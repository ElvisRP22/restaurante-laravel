<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id_empleado');
            $table->string('dni',10)->unique();
            $table->string('nombre',100);
            $table->string('rol',50);
            $table->string('usuario', 50)->unique();
            $table->string('clave');
            $table->rememberToken();
            $table->date('fecha_ingreso')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
