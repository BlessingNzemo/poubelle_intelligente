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

    /**
     * Récupère les détails d'une poubelle avec ses données
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBinDetails($id)
    {
        try {
            // Utilise la relation binDatas définie dans le modèle Bin
            $bin = Bin::with(['binDatas' => function($query) {
                $query->latest()->limit(1);
            }])->find($id);

            if (!$bin) {
                Log::warning('Poubelle non trouvée.', ['bin_id' => $id]);
                return response()->json([
                    'message' => 'Poubelle non trouvée'
                ], 404);
            }

            // Récupère les dernières données de la poubelle
            $lastData = $bin->binDatas->first();

            // Formater les données de base de la poubelle
            $binDetails = [
                'id' => $bin->id,
                'name' => $bin->name,
                'serial_number' => $bin->serial_number,
                'location' => $bin->location,
                'created_at' => $bin->created_at->format('d/m/Y H:i'),
                'updated_at' => $bin->updated_at->format('d/m/Y H:i'),
                'has_sensor_data' => !is_null($lastData),
                'sensor_status' => !is_null($lastData) ? 'active' : 'en attente de données'
            ];

            // Ajouter les données des capteurs si disponibles
            if ($lastData) {
                $binDetails['sensor_data'] = [
                    'fill_level' => $lastData->fill_level,
                    'temperature' => $lastData->temperature,
                    'humidity' => $lastData->humidity,
                    'is_open' => $lastData->is_open,
                    'latitude' => $lastData->latitude,
                    'longitude' => $lastData->longitude,
                    'last_update' => $lastData->created_at->format('d/m/Y H:i')
                ];
            }

            Log::info('Détails de la poubelle récupérés avec succès.', [
                'bin_id' => $id,
                'has_sensor_data' => !is_null($lastData)
            ]);

            return response()->json([
                'status' => 'success',
                'message' => !is_null($lastData)
                    ? 'Détails de la poubelle récupérés avec succès'
                    : 'Détails de base récupérés, en attente des données des capteurs',
                'data' => $binDetails
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des détails de la poubelle.', [
                'bin_id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des détails'
            ], 500);
        }
    }

    /**
     * Supprime une poubelle spécifique
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            Log::info('Tentative de suppression de la poubelle.', ['bin_id' => $id]);

            $bin = Bin::find($id);

            if (!$bin) {
                Log::warning('Poubelle non trouvée.', ['bin_id' => $id]);
                return response()->json([
                    'message' => 'Poubelle non trouvée'
                ], 404);
            }

            // Vérifier si l'utilisateur connecté est autorisé à supprimer cette poubelle
            if (Auth::id() !== $bin->user_id) {
                Log::warning('Utilisateur non autorisé à supprimer cette poubelle.', [
                    'bin_id' => $id,
                    'user_id' => Auth::id()
                ]);
                return response()->json([
                    'message' => 'Non autorisé'
                ], 403);
            }

            // Supprimer les données associées à la poubelle
            $bin->binDatas()->delete();

            $bin->delete();

            Log::info('Poubelle supprimée avec succès.', ['bin_id' => $id]);
            return response()->json([
                'message' => 'Poubelle supprimée avec succès'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la poubelle.', [
                'bin_id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Une erreur est survenue lors de la suppression'
            ], 500);
        }
    }
}
