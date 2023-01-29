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
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco_custo',10,2)->nullable();
            $table->decimal('preco_venda',10,2)->nullable();
            $table->decimal('preco_promocional',10,2)->nullable();
            $table->integer('situacao');
            $table->integer('estoque');
            $table->boolean('sob_consulta');
            $table->integer('disponibilidade');
            $table->string('gtin');
            $table->string('mpn');
            $table->string('ncm');
            $table->string('link_video');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('pacote_id')->references('id')->on('pacote');
            $table->foreignId('seo_id')->references('id')->on('seo_produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
};
