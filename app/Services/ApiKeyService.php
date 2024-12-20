<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiKeyService
{
    public function generateApiKey()
    {
        $apiKey = Str::random(64);

        // Enregistrer la clé API dans la base de données
        DB::table('api_keys')->insert([
            'key' => $apiKey,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $apiKey;
    }
}
