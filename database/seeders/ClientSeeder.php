<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\fonction;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $famille = Fonction::where('name', 'Famille')->firstOrFail();

        $clients = [
            'Bilel',
            'Merieme',
            'Fayçal',
            'Fatima',
        ];

        foreach ($clients as $nom) {
            Client::firstOrCreate(
                ['name' => $nom],
                ['fonction_id' => $famille->id]
            );
        }
    }
}
