<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateChatboxTable extends Migration
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
            $table->string('name', 100)->nullable();
            $table->text('title')->nullable();
            $table->text('heading')->nullable();
            $table->text('sub_heading')->nullable();
            $table->text('abstract')->nullable();
            $table->text('content')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->mediumText('banner')->nullable();
            $table->text('images')->nullable();
            $table->boolean('compile')->default(false)->nullable();
            $table->string('view', 20)->default('default')->nullable();
            $table->string('category', 20)->default('default')->nullable();
            $table->integer('order')->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['Show', 'Hide'])->default('Show')->nullable();
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
