<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('unidade_medida', ['quilos', 'unidade']);
            $table->float('quantidade');
            $table->enum('status', ['disponivel', 'retirado', 'expirado']);
            $table->dateTime('validade');
            $table->integer('user_id')
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('endereco_id')
                ->foreign('endereco_id')
                ->references('id')
                ->on('enderecos');
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
        Schema::dropIfExists('doacoes');
    }
}
