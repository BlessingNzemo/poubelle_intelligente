<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BinController extends Controller
{
    /**
     * Crée une nouvelle poubelle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('Tentative de création d\'une nouvelle poubelle.', ['request' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|string|unique:bins',
            'name' => 'nullable|string',
            'location' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            Log::warning('La validation a échoué lors de la création d\'une nouvelle poubelle.', ['errors' => $validator->errors()->toArray()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Vérifie si la poubelle existe déjà
            if (Bin::where('serial_number', $request->input('serial_number'))->exists()) {
                Log::warning('Une poubelle avec ce numéro de série existe déjà.', ['serial_number' => $request->input('serial_number')]);
                return response()->json(['message' => 'Une poubelle avec ce numéro de série existe déjà.'], 409);
            }

            $bin = Bin::create([
                'serial_number' => $request->input('serial_number'),
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'user_id' => $request->input('user_id'),
            ]);

            Log::info('Nouvelle poubelle créée avec succès.', ['bin_id' => $bin->id]);
            return response()->json($bin, 201);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'une nouvelle poubelle.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'La création de la poubelle a échoué.'], 500);
        }
    }


    /**
     * Récupère toutes les poubelles d'un utilisateur spécifique
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBinsByUserId($userId)
    {
        try {
            Log::info('Tentative de récupération des poubelles.', ['user_id' => $userId]);

            // Récupérer les poubelles sans les données pour l'instant
            $bins = Bin::where('user_id', $userId)->get();

            if ($bins->isEmpty()) {
                Log::info('Aucune poubelle trouvée pour cet utilisateur.', ['user_id' => $userId]);
                return response()->json([
                    'message' => 'Aucune poubelle trouvée pour cet utilisateur',
                    'data' => []
                ], 200);
            }

            Log::info('Poubelles récupérées avec succès.', [
                'user_id' => $userId,
                'count' => $bins->count()
            ]);

            return response()->json([
                'message' => 'Poubelles récupérées avec succès',
                'data' => $bins
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des poubelles.', [
                'user_id' => $userId,
                'message' => $e->getMessage()
            ]);
            
            return response()->json([
                'message' => 'Une erreur est survenue lors de la récupération des poubelles'
            ], 500);
        }
    }
}