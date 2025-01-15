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
        Schema::create('prodotti', function (Blueprint $table) {
            $table->id();
            $table->text('descrizione'); // Scheda tecnica del prodotto
            $table->text('tecniche_d_uso'); // Tecniche d'uso del prodotto
            $table->text('modalita_installazione'); // Modalità d'installazione del prodotto
            $table->foreignId('tipo_prodotto_id') // Colonna tipo_prodotto_id
                ->constrained('tipi_prodotto') // Collega alla tabella tipi_prodotto
                ->onDelete('cascade'); // Elimina i prodotti se il tipo viene eliminato
            $table->text('foto'); // Percorso della foto
            $table->timestamps(); // Timestamps per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodotti');
    }
};
