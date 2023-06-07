<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
           /*  nella tabella Projects -> mi crei una colonna di un grande intero chiamata 'type_id'->
             che puo essere omessa (non è obbligatoria)->
              e deve essere messa dopo la colonna 'id' */
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            /* nella tabella Projects -> specifici che la colonna 'type_id' è una foreign key ->
             fa riferimento alla colonna 'id' ->
              della tabella types ->
               se viene eliminato l ' id della ossociato mi imposti un valore nullo */
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //al termine della migrate cancella l'associazione alla foreign kay
            $table->dropForeign('porjects_type_id_foreign');
            //al termine della migrate cancella la colonna associata alla foreign kayp 
            $table->dropColumn('type_id');


        });
    }
};
