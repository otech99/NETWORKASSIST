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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Chiave primaria auto-incrementante
            $table->string('email')->unique(); // Email dell'utente, unico
            $table->string('username', 20)->unique(); // Username dell'utente, unico
            $table->string('nome'); // Nome dell'utente
            $table->string('cognome'); // Cognome dell'utente
            $table->string('data_di_nascita'); // Data di nascita
            $table->string('password'); // Password dell'account
            $table->string('tipo_account'); // Tipo di account (es. admin, tecnico, staff)
            $table->string('tipo_prodotto')->nullable(); // Tipo di prodotto (es. R, SW, AC)

            // Riferimento al centro di assistenza (BIGINT, nullable)
            $table->unsignedBigInteger('centro_assistenza_id')->nullable();

            // Specializzazione per i tecnici, nullable per gli altri tipi di account
            $table->string('specializzazione')->nullable();

            // Creazione della chiave esterna che fa riferimento alla tabella centri_assistenza
            $table->foreign('centro_assistenza_id')
                  ->references('id')
                  ->on('centri_assistenza')
                  ->onDelete('set null');

            $table->timestamps(); // Timestamps per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rimozione della chiave esterna
            $table->dropForeign(['centro_assistenza_id']);
        });

        Schema::dropIfExists('users');
    }
};
