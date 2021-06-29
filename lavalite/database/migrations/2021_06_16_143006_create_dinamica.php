<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinamica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinamica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('parte_1');
            $table->string('nome_classe')->unique();
            $table->string('parte_2');
            $table->text('conversa_ordem');
            $table->string('final');
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
        Schema::dropIfExists('dinamica');
    }
}
