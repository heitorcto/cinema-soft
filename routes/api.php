<?php

use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

Route::post('/registrar', [AdministradorController::class, "registrar"]);
Route::post('/logar', [AdministradorController::class, "logar"]);
Route::post('/sair', [AdministradorController::class, "sair"])->middleware('auth:sanctum');

Route::post('/cinema/registrar', [CinemaController::class, "registrar"])->middleware('auth:sanctum');
