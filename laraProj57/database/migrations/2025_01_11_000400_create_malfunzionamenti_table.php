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
        Schema::create('malfunzionamenti', function (Blueprint $table) {
            $table->id(); // Auto-increment per la chiave primaria
            $table->unsignedBigInteger('prodotto_id'); // Chiave esterna verso la tabella prodotti
            $table->text('descrizione'); // Descrizione del malfunzionamento
            $table->timestamps();

            // Definisci la chiave esterna
            $table->foreign('prodotto_id')
                  ->references('id')
                  ->on('prodotti')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malfunzionamenti');
    }
};
