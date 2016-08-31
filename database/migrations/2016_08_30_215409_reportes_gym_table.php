<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportesGymTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('reportes_gym', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('miembro_id');
        $table->string('concepto');
        $table->integer('costo');
        $table->integer('caja');
        $table->date('fecha');
        $table->integer('user_id');
        $table->integer('sucursal_id');
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
        //
    }
}
