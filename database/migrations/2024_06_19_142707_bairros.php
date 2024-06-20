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
        Schema::create('bairros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cidade')->unsigned()->index()->nullable();
            $table->string('nome');
            $table->timestamps();
            $table->foreign('id_cidade')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bairros');
    }
};
