<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Récupère la liste de tous les utilisateurs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        Log::info('En attente de récupération des utilisateurs');

        try {
            $users = User::all();

            if ($users->isEmpty()) {
                Log::warning('Pas d\'utilisateurs trouvés dans la base de données');
                return response()->json(['message' => 'No users found.'], 404);
            }

            Log::info('Successfully retrieved all users.', ['count' => count($users)]);
            return response()->json($users);

        } catch (\Exception $e) {
            Log::error('Error retrieving users.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Failed to retrieve users.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
