<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Funcoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->string('nome')->unique();
            $table->string('func_1');
            $table->string('nome_func')->unique();
            $table->string('func_2');
            $table->string('func_3');
            $table->string('func_4');
            $table->string('nome_prox');
            $table->string('func_5');
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
