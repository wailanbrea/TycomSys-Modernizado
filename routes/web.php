<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;

// API routes para Laravel
Route::prefix('api')->group(function () {
    // Aquí puedes agregar tus rutas de API
    Route::get('/health', function () {
        return response()->json(['status' => 'OK', 'message' => 'Laravel API funcionando correctamente']);
    });
});

// Ruta principal para servir la aplicación React
Route::get('/', [ReactController::class, 'index']);

// Ruta específica para archivos estáticos
Route::get('/static/{path}', [ReactController::class, 'assets'])->where('path', '.*');

// Catch-all route para React Router (debe ir al final)
Route::get('/{any}', [ReactController::class, 'index'])->where('any', '.*');
