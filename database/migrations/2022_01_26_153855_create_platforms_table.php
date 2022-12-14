<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('descripcion', 100)->nullable();
            $table->enum('estado', ['ACTIVO', 'BLOQUEADO', 'OTRO'])->default('ACTIVO');
            $table->enum('tipo', ['CORREO', 'USUARIO', 'AMBOS']);
            $table->enum('perfiles', ['SI', 'NO']);
            $table->string('image', 100)->nullable();
            $table->decimal('precioEntera', 10, 2);
            $table->decimal('precioPerfil', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
