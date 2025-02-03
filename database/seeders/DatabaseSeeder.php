<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bins;
use App\Models\Bin_data;
use App\Models\Bin_alert;
use App\Models\Maintenance_log;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Création des utilisateurs
        User::factory(10)->create();

        // Création d'un admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@smartbin.cd',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Création des poubelles
        Bins::factory(50)->create()->each(function ($bin) {
            // Génération de données pour chaque poubelle
            // Bin_data::factory(30)->create(['bin_id' => $bin->id]);

            // Création d'alertes pour certaines poubelles
            // if (rand(0, 1)) {
                // Bin_alert::factory(rand(1, 3))->create(['bin_id' => $bin->id]);
            

            // Création de logs de maintenance
            // Maintenance_log::factory(rand(0, 5))->create(['bin_id' => $bin->id]);

            // Assignation de la poubelle à des utilisateurs
            $bin->assignedUsers()->attach(
                User::inRandomOrder()->limit(rand(1, 3))->pluck('id')
            );
        });
    }
}
