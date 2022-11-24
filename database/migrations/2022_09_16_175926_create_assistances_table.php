<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();

            /*$table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('area_trabajos');*/

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('employees');

            $table->date('fecha');
            $table->string('motivo',500)->nullable();
            $table->string('comprobante',100)->nullable();
            $table->enum('estadoA',['Permiso','Licencia'])->default('Permiso');
            
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
        Schema::dropIfExists('assistances');
    }
}
