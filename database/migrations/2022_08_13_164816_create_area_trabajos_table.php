<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_trabajos', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('cargo_id');
            // $table->foreign('cargo_id')->references('id')->on('cargos');

            $table->string('nameArea',255);
            $table->string('descriptionArea',500)->nullable();
            $table->enum('estadoA',['Activo','Inactivo'])->default('Activo')->nullable();
            $table->time('RetrasoPermitido');

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
        Schema::dropIfExists('area_trabajos');
    }
}
