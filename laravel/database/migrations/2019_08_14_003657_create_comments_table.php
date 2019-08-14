<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            // $table->string('time');
            $table->bigInteger('user_id')->unsigned()->nullable();
            //$table->bigInteger('post_id')->unsigned()->nullable();
            $table->timestamps();
        });

        //Chave estrangeira que referencia o usuário que fez o comentário.
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //Chave estrangeira que referencia o post em que o comentário foi feito.
        // Schema::table('comments', function (Blueprint $table) {
        //     $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
