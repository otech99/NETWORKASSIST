<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding per la tabella 'users'
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'user1@admin.com',
                'username' => 'adminadmin',
                'nome' => 'Mario',
                'cognome' => 'Rossi',
                'data_di_nascita' => '1999-09-12',
                'password' => Hash::make('Z4SpZ4Sp'),
                'tipo_account' => 'admin',
            ],
            [
                'id' => 2,
                'email' => 'user2@staff.com',
                'username' => 'staffstaff',
                'nome' => 'Luigi',
                'cognome' => 'Bianchi',
                'data_di_nascita' => '1996-03-25',
                'password' => Hash::make('Z4SpZ4Sp'),
                'tipo_account' => 'staff',
            ],
            [
                'id' => 3,
                'email' => 'user3@tecn.com',
                'username' => 'tecntecn',
                'nome' => 'Paolo',
                'cognome' => 'Rossi',
                'data_di_nascita' => '2002-01-13',
                'password' => Hash::make('Z4SpZ4Sp'),
                'tipo_account' => 'tecnico',
            ],
        ]);

        // Seeding per la tabella 'centri_assistenza'
        DB::table('centri_assistenza')->insert([
            [ 'indirizzo' => 'Via Centro 1', 'citta' => 'Roma', 'telefono' => '0612345678'],
            [ 'indirizzo' => 'Via Centro 2', 'citta' => 'Milano', 'telefono' => '0223456789'],
        ]);

        // Seeding per la tabella 'tipi_prodotto'
        DB::table('tipi_prodotto')->insert([
            ['id' => 1, 'nome' => 'Router'],
            ['id' => 2, 'nome' => 'Switch'],
            ['id' => 3, 'nome' => 'Access Controller'],
        ]);

        // Seeding per la tabella 'prodotti'
        DB::table('prodotti')->insert([
            [
                
                'descrizione' => 'Router Huawei',
                'tecniche_d_uso' => 'Uso del prodotto A',
                'modalita_installazione' => 'Installazione del prodotto A',
                'tipo_prodotto_id' => 1, // Relazione con 'Router'
                'foto' => 'foto_router_huawei.jpg',
            ],
            [
                
                'descrizione' => 'Switch Cisco',
                'tecniche_d_uso' => 'Uso del prodotto B',
                'modalita_installazione' => 'Installazione del prodotto B',
                'tipo_prodotto_id' => 2, // Relazione con 'Switch'
                'foto' => 'foto_switch_cisco.jpg',
            ],
            [
                
                'descrizione' => 'Access Controller Mikrotik',
                'tecniche_d_uso' => 'Uso del prodotto C',
                'modalita_installazione' => 'Installazione del prodotto C',
                'tipo_prodotto_id' => 3, // Relazione con 'Access Controller'
                'foto' => 'foto_access_controller_mikrotik.jpg',
            ],
        ]);

        // Seeding per la tabella 'malfunzionamenti'
        DB::table('malfunzionamenti')->insert([
            [
                'prodotto_id' => '1',
                'descrizione' => 'Il prodotto non si accende.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'prodotto_id' => '2',
                'descrizione' => 'Schermo danneggiato.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'prodotto_id' => '3',
                'descrizione' => 'Il prodotto si surriscalda durante l\'uso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seeding per la tabella 'soluzioni'
        DB::table('soluzioni')->insert([
            [

                'malfunzionamento_id' => '1',
                'descrizione' => 'Controllare il cavo di alimentazione e la presa di corrente.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'malfunzionamento_id' => '2',
                'descrizione' => 'Sostituire lo schermo presso un centro assistenza autorizzato.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'malfunzionamento_id' => '3',
                'descrizione' => 'Utilizzare il prodotto in un ambiente ben ventilato.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
