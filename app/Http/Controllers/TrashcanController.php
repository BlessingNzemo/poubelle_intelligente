<?php

namespace App\Http\Controllers;

use App\Models\Trashcan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrashcanController extends Controller
{
    public function updateData(Request $request)
    {

        
        try {
            Log::info('Début de la mise à jour des données de la poubelle', [
                'api_key' => $request->api_key,
                'request_data' => $request->all()
            ]);

            $request->validate([
                'api_key' => 'required|exists:trashcans,api_key',
                'fill_percentage' => 'required|numeric|min:0|max:100',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            $trashcan = Trashcan::where('api_key', $request->api_key)->firstOrFail();

            Log::info('Poubelle trouvée', ['trashcan_id' => $trashcan->id]);

            $data = $trashcan->data()->create([
                'fill_percentage' => $request->fill_percentage,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_full' => $request->fill_percentage >= 90,
            ]);

            Log::info('Données de la poubelle mises à jour avec succès', [
                'trashcan_id' => $trashcan->id,
                'fill_percentage' => $data->fill_percentage,
                'is_full' => $data->is_full
            ]);

            if ($data->is_full) {
                Log::warning('La poubelle est pleine', ['trashcan_id' => $trashcan->id]);
                // Envoyer une notification
                // Notification::send(User::all(), new TrashcanFullNotification($trashcan));
            }

            return response()->json(['message' => 'Data updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erreur de validation lors de la mise à jour des données', [
                'errors' => $e->errors(),
                'api_key' => $request->api_key,
                'request_data' => $request->all()
            ]);
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Poubelle non trouvée', [
                'api_key' => $request->api_key,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Poubelle non trouvée'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour des données de la poubelle', [
                'error' => $e->getMessage(),
                'api_key' => $request->api_key
            ]);
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

    public function getStatus($id)
    {
        try {
            Log::info('Récupération du statut de la poubelle', ['trashcan_id' => $id]);

            $trashcan = Trashcan::findOrFail($id);
            $latestData = $trashcan->data()->latest()->first();

            if (!$latestData) {
                Log::warning('Aucune donnée trouvée pour la poubelle', ['trashcan_id' => $id]);
                return response()->json(['error' => 'Aucune donnée disponible'], 404);
            }

            Log::info('Statut de la poubelle récupéré avec succès', ['trashcan_id' => $id]);

            return response()->json([
                'name' => $trashcan->name,
                'fill_percentage' => $latestData->fill_percentage,
                'latitude' => $latestData->latitude,
                'longitude' => $latestData->longitude,
                'is_full' => $latestData->is_full,
                'last_updated' => $latestData->created_at,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Poubelle non trouvée', [
                'trashcan_id' => $id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Poubelle non trouvée'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération du statut de la poubelle', [
                'error' => $e->getMessage(),
                'trashcan_id' => $id
            ]);
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }
}
