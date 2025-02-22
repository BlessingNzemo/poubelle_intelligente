<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BinDataController;
use App\Http\Controllers\Api\UserController; // Import the UserController
use App\Http\Controllers\Api\SerialNumberController;
use App\Http\Controllers\Api\BinController; //
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/bin-data', [BinDataController::class, 'store']);

// Route to get all users
Route::get('/users', [UserController::class, 'index']);
// Route::get('/user/bins', [BinController::class, 'getUserBins']);
Route::get('/generate-serial', [SerialNumberController::class, 'generate']);
Route::post('/bins', [BinController::class, 'store']);
Route::get('/bins/{userId}', [BinController::class, 'getBinsByUserId']);