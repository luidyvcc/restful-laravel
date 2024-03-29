<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locacaos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->bigInteger('filme_id')->unsigned();
            $table->foreign('filme_id')
                            ->references('id')
                            ->on('filmes')
                            ->onUpdate('cascade')
                            ->onDelete('cascade');

            $table->date('data_locacao');

            $table->softDeletes();

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
        Schema::dropIfExists('locacaos');
    }
}
