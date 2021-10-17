<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoacaoRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacao_realizadas', function (Blueprint $table) {
            $table->id();
            $table->integer('doador_id')
                ->foreign('doador_id')
                ->references('id')
                ->on('users');
            $table->integer('user_id')
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('doacao_id')
                ->foreign('doacao_id')
                ->references('id')
                ->on('doacoes');
                $table->string('nome');
                $table->enum('unidade_medida', ['quilos', 'unidade']);
                $table->float('quantidade');


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
        Schema::dropIfExists('doacao_realizadas');
    }
}
