<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {    


        User::firstOrCreate(
            ['email' => 'admin@smartbin.cd'],
            [
                'name' => 'Admin SmartBin',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
        // Création de l'admin
        User::create([
            'name' => 'Admin SmartBin',
            'email' => 'admin@smartbin.cd',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Génération de 50 utilisateurs fictifs
        User::factory()
            ->count(50)
            ->state([
                'role' => 'technicien', // Valeur par défaut
                'password' => Hash::make('Password123!') // Mot de passe commun pour les tests
            ])
            ->create();
    }
}
