<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            //$table->timestamps();

            $table->unsignedBigInteger('post_id');
            //La colonna creata ('post_id') sarà:
            //una foreign key(post_id) con referenza la colonna 'id' della table Categories
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->unsignedBigInteger('tag_id');
            //La colonna creata ('tag_id') sarà:
            //una foreign key(tag_id) con referenza la colonna 'id' della table Categories
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
