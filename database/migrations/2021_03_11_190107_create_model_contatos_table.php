<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tel');
            $table->string('avatar')->default('/vendor/sem_foto.png');
            $table->string('endereco')->default('S/N');
            $table->integer('defaultImg')->default('1');
            $table->integer('notify')->default('0');
            $table->unsignedBigInteger('id_bairro')->default(1);
            $table->foreign('id_bairro')->references('id')->on('bairros')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('contatos');
    }
}
