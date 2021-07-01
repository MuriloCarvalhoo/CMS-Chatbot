<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class ChatboxBD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
         * Table: chatboxs
         */
        Schema::create(config('litecms.chatbox.chatbox.table'), function ($table) {
            $table->increments('id')->unsigned();
            $table->string('conversa', 100)->nullable();
            $table->string('tipo', 100)->nullable();
            $table->string('nome')->nullable();
            $table->text('ouvir')->nullable();
            $table->text('validar')->nullable();
            $table->text('pergunta')->nullable();
            $table->text('resposta')->nullable();
            $table->text('nome_prox')->nullable();
            $table->text('file')->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('litecms.chatbox.chatbox.table'));
    }
}
