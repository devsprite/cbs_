<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataOperateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_operateurs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('date');
            $table->dateTime('heure_de_debut')->nullable();
            $table->dateTime('duree')->nullable();
            $table->tinyInteger('nombre_agent')->nullable();
            $table->string('intervenant')->nullable();
            $table->string('mobile')->nullable();
            $table->string('numero_canton')->nullable();
            $table->string('numero_convoyeur')->nullable();
            $table->string('defaut_eds')->nullable();
            $table->string('defaut_tomographe')->nullable();
            $table->string('saturation_chute')->nullable();
            $table->string('cause')->nullable();
            $table->string('mode_de_defaillance')->nullable();
            $table->string('symptome')->nullable();
            $table->text('commentaires')->nullable();
            $table->boolean('valid')->default(1);
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
        Schema::drop('data_operateurs');
    }
}
