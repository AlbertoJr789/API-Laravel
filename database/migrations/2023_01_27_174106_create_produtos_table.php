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
            $table->string('marca')->nullable();
            $table->decimal('preco_custo',10,2)->nullable();
            $table->decimal('preco_venda',10,2)->nullable();
            $table->decimal('preco_promocional',10,2)->nullable();
            $table->integer('situacao'); // 1(Novo) - 0(Usado)
            $table->integer('estoque');
            $table->boolean('sob_consulta'); // 1(Sim) - 0(Não)
            $table->integer('disponibilidade');
            $table->string('sku');
            $table->string('gtin')->nullable();
            $table->string('mpn')->nullable();
            $table->string('ncm')->nullable();
            $table->string('link_video')->nullable();
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
