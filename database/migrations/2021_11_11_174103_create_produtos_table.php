<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('content')->nullable();
            $table->text('notas')->nullable();
            $table->string('slug')->nullable();
            $table->string('headline')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('views')->default(0);
            $table->unsignedInteger('categoria');
            $table->integer('cat_pai')->nullable();
            $table->integer('comentarios')->nullable();
            $table->integer('status')->nullable();
            $table->integer('ativacao')->nullable();
            $table->integer('tipo_pagamento')->nullable();
            $table->string('thumb_legenda')->nullable(); 
            $table->date('publish_at')->nullable();

            /** pricing and values */
            $table->boolean('exibivalores')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->decimal('valor_vista', 10, 2)->nullable();
            $table->decimal('valor_promocional', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('categoria')->references('id')->on('cat_produtos')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
