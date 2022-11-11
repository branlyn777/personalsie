<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();

            $table->string('name',255);

            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('area_trabajos');

            //$table->integer('parent_id')->nullable()->default('0');

            $table->enum('estado',['Disponible','No Disponible'])->default('Disponible');

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
        Schema::dropIfExists('cargos');
    }
}
