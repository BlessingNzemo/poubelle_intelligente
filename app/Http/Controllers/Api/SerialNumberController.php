<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SerialNumberController extends Controller
{
    /**
     * Génère un numéro de série unique pour une poubelle.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(): JsonResponse
    {
        Log::info('Attempting to generate a unique serial number.');

        try {
            $prefix = 'POUB';
            $randomNumber = mt_rand(100, 999); // Génère un nombre aléatoire entre 100 et 999
            $countryCode = 'DRC';

            $serialNumber = $prefix . '/' . $randomNumber . '/' . $countryCode;

            Log::info('Successfully generated a unique serial number.', ['serial_number' => $serialNumber]);
            return response()->json(['serial_number' => $serialNumber]);

        } catch (\Exception $e) {
            Log::error('Error generating serial number.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Failed to generate serial number.'], 500);
        }
    }
}