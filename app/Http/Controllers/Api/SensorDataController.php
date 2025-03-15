<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bin;
use App\Models\BinData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SensorDataController extends Controller
{
    /**
     * Enregistre les données des capteurs pour une poubelle spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $serial_number
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $serial_number)
    {
        Log::info('Tentative d\'enregistrement des données des capteurs.', [
            'serial_number' => $serial_number,
            'request' => $request->all()
        ]);

        // Validation des données entrantes
        $validator = Validator::make($request->all(), [
            'fill_level' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'is_open' => 'nullable|boolean',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            Log::warning('La validation des données des capteurs a échoué.', [
                'serial_number' => $serial_number,
                'errors' => $validator->errors()->toArray()
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Recherche de la poubelle par numéro de série
            $bin = Bin::where('serial_number', $serial_number)->first();

            if (!$bin) {
                Log::warning('Aucune poubelle trouvée avec ce numéro de série.', ['serial_number' => $serial_number]);
                return response()->json(['message' => 'Aucune poubelle trouvée avec ce numéro de série.'], 404);
            }

            // Création des données des capteurs
            $binData = new BinData();
            $binData->bin_id = $bin->id;

            // Assignation des valeurs des capteurs si elles sont fournies
            $binData->fill_level = $request->input('fill_level');
            $binData->temperature = $request->input('temperature');
            $binData->humidity = $request->input('humidity');
            $binData->is_open = $request->input('is_open');
            $binData->latitude = $request->input('latitude');
            $binData->longitude = $request->input('longitude');

            $binData->save();

            Log::info('Données des capteurs enregistrées avec succès.', [
                'bin_id' => $bin->id,
                'bin_data_id' => $binData->id
            ]);

            return response()->json(['message' => 'Données des capteurs enregistrées avec succès.'], 201);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement des données des capteurs.', [
                'serial_number' => $serial_number,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Erreur lors de l\'enregistrement des données des capteurs.'], 500);
        }
    }
}
