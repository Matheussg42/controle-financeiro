<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecebimentoParcelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebimento_parcelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('fk_user_id');
            $table->foreign('fk_user_id')->references('id')->on('users');
            $table->string('nome');
            $table->float('valor');
            $table->longText('comentario');
            $table->integer('parcelas');
            $table->string('inicio');
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
        Schema::dropIfExists('recebimento_parcelas');
    }
}
