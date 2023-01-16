<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;

Route::post('/registrar', [AdministradorController::class, "registrar"]);
Route::post('/logar', [AdministradorController::class, "logar"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('cinema')->group(function () {
        Route::post('/registrar', [CinemaController::class, "registrar"]);
        Route::post('/atualizar', [CinemaController::class, "atualizar"]);
        Route::get('/listar', [CinemaController::class, "listar"]);
        Route::delete('/excluir', [CinemaController::class, "excluir"]);
    });

    Route::prefix('cinema')->group(function () {
        Route::post('/registrar', [SalaController::class, "registrar"]);
        Route::post('/atualizar', [SalaController::class, "atualizar"]);
        Route::get('/listar', [SalaController::class, "listar"]);
        Route::delete('/excluir', [SalaController::class, "excluir"]);
    });

    Route::post('/sair', [AdministradorController::class, "sair"]);
});
