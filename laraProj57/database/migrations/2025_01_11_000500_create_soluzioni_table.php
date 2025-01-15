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
        Schema::create('soluzioni', function (Blueprint $table) {
            $table->id(); // L'ID ora è auto-incrementato
            $table->unsignedBigInteger('malfunzionamento_id'); // Chiave esterna
            $table->text('descrizione'); // Descrizione della soluzione
            $table->timestamps();

            // Definisci la chiave esterna
            $table->foreign('malfunzionamento_id')
                  ->references('id')
                  ->on('malfunzionamenti')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soluzioni');
    }
};
