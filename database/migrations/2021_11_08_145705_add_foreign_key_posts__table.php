<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Posts', function (Blueprint $table) {
            //CREO LA MIA COLONNA CATEGORY_ID

            //Aggiunta del metodo nullable. In questo modo il post può non avere una categoria associata
            //Con il metodo after('decidiamo dove inserire la nuova colonna nullable()')
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');
            //La colonna creata ('category_id') sarà:
            //una foreign key(category_id) con referenza la colonna 'id' della table Categories
            $table->foreign('category_id')->references('id')->on('Categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Posts', function (Blueprint $table) {
            //MI DO LA POSSIBILITA' DI ELIMINARE LA COLONNA APPENA CREATA
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
