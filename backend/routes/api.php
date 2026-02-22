<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Estas rutas se cargan automáticamente bajo el prefijo /api
| y el middleware "api".
|--------------------------------------------------------------------------
*/

// Ruta de prueba
Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente'
    ]);
});

// Rutas públicas básicas para probar datos
Route::get('/users', function () {
    return App\Models\User::all();
});

Route::get('/clients', function () {
    return App\Models\Client::all();
});

// Rutas protegidas solo para admin (si tus controladores existen más adelante)
// Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->group(function () {
//     Route::apiResource('clients', ClientController::class);
// });
