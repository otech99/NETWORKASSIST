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
        Schema::create('centri_assistenza', function (Blueprint $table) {
            $table->id();
            $table->string('indirizzo'); // Indirizzo del centro di assistenza
            $table->string('citta'); // Città in cui si trova il centro
            $table->string('telefono'); // Numero di telefono del centro di assistenza
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centri_assistenza');
    }
};
