<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tipi_prodotto', function (Blueprint $table) {
            $table->id(); // ID automatico come chiave primaria
            $table->string('nome')->unique(); // Nome del tipo di prodotto univoco
            $table->timestamps(); // Timestamps per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tipi_prodotto');
    }
};
