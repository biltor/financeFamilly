<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Caisse;

class CaisseSeeder extends Seeder
{
    public function run(): void
    {
        $client = client::where('id', 1,);

        $caisse_names = ['caisse_principal euro', 'caisse principal dzd'];


        foreach ($caisse_names as $title) {
            Caisse::Create(

            );
        }
    }
}
