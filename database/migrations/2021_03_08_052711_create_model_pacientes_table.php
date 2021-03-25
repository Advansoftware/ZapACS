<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

class CreateModelPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('CNS')->unique();
            $table->unsignedBigInteger('id_fam');
            $table->foreign('id_fam')->references('id')->on('familias')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_ver');
            $table->foreign('id_ver')->references('id')->on('verificados')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome');
            $table->string('whats');
            $table->integer('ha');
            $table->integer('dia');
            $table->integer('gestante');
            $table->date('dn');
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
        Schema::dropIfExists('pacientes');
    }
}
