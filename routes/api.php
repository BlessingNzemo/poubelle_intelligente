<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrashcanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// routes/api.php

