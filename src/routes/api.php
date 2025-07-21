<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BungaController;

use Illuminate\Support\Facades\Route;

// tests
Route::prefix('bungas')->middleware('apikey')->group(function () {
    Route::get('/', [BungaController::class, 'index']);     // GET /api/tests
    Route::get('{id}', [BungaController::class, 'show']);   // GET /api/tests/{id}
    Route::post('/', [BungaController::class, 'store']);    // POST /api/tests
    Route::put('{id}', [BungaController::class, 'update']); // PUT /api/tests/{id}
    Route::delete('{id}', [BungaController::class, 'destroy']); // DELETE /api/tests/{id}
    Route::post('/decrypt', [BungaController::class, 'decryptResponse']);
});


