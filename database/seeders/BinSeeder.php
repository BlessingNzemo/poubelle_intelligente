<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bins;

class BinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Bins::factory()
            ->count(50) // Génère 50 poubelles normales
            ->create();

        Bins::factory()
            ->count(10)
            ->disconnected() // Utilise l'état personnalisé
            ->create();

        Bins::factory()
            ->count(5)
            ->full()
            ->create();
    }
}
