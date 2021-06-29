<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conversas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_conversa');
            $table->string('ordem')->unique();
            $table->string('nome_func');
            $table->string('parte_1');
            $table->string('pergunta');
            $table->string('parte_2');
            $table->string('resposta');
            $table->string('parte_3');
            $table->string('nome_prox');
            $table->string('parte_4');
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
