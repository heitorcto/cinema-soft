<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;

Route::post('/registrar', [AdministradorController::class, "registrar"]);
Route::post('/logar', [AdministradorController::class, "logar"]);
Route::post('/sair', [AdministradorController::class, "sair"])->middleware('auth:sanctum');

Route::post('/cinema/registrar', [CinemaController::class, "registrar"])->middleware('auth:sanctum');
Route::post('/cinema/atualizar', [CinemaController::class, "atualizar"])->middleware('auth:sanctum');
Route::get('/cinema/listar', [CinemaController::class, "listar"])->middleware('auth:sanctum');
Route::delete('/cinema/excluir', [CinemaController::class, "excluir"])->middleware('auth:sanctum');

Route::post('/sala/registrar', [SalaController::class, "registrar"])->middleware('auth:sanctum');
Route::post('/sala/atualizar', [SalaController::class, "atualizar"])->middleware('auth:sanctum');
Route::get('/sala/listar', [SalaController::class, "listar"])->middleware('auth:sanctum');
Route::delete('/sala/excluir', [SalaController::class, "excluir"])->middleware('auth:sanctum');
