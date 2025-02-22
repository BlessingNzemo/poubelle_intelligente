<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bin_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\BinData;

class BinDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Incoming request to /bin-data', [
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
            'body' => $request->all(),
        ]);

        $validator = Validator::make($request->all(), [
            'bin_id' => 'required|uuid|exists:bins,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'fill_level' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'is_open' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for /bin-data', [
                'errors' => $validator->errors()->toArray(),
                'body' => $request->all(),
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $binData = BinData::create($request->all());

            Log::info('New Bin_data created', [
                'bin_data_id' => $binData->id,
                'bin_id' => $binData->bin_id,
            ]);

            return response()->json($binData, 201);
        } catch (\Exception $e) {
            Log::error('Error creating Bin_data', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'body' => $request->all(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
