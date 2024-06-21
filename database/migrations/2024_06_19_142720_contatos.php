<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario')->unsigned()->index()->nullable();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('telefone');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->string('cep');
            $table->bigInteger('id_bairro')->unsigned()->index()->nullable();
            $table->string('lat_long');
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_bairro')->references('id')->on('bairros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
