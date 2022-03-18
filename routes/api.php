<?php

use App\Http\Utils\DefaultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::post('users', [App\Http\Controllers\UserController::class, 'store']);
Route::prefix('auth')->group(function () {
    Route::post('login', [App\Http\Controllers\Auth\Api\LoginController::class, 'login']);
});

Route::post('logout', [App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('autenticar', [App\Http\Controllers\Auth\Api\RegisterController::class, 'verifyPermission'])->middleware('auth:sanctum');
Route::apiResource('sistemas', App\Http\Controllers\SistemaController::class)->middleware(['auth:sanctum']);
Route::apiResource('grupos', App\Http\Controllers\GrupoController::class)->middleware(['auth:sanctum']);
Route::apiResource('modulos', App\Http\Controllers\ModuloController::class)->middleware(['auth:sanctum']);
Route::apiResource('usuariosistemas', App\Http\Controllers\UsuarioSistemaController::class)->middleware(['auth:sanctum']);
Route::apiResource('grupomodulos', App\Http\Controllers\GrupoModuloController::class)->middleware(['auth:sanctum']);

 
 Route::apiResource('usuariosistemagrupos',App\Http\Controllers\UsuarioSistemaGrupoController::class)->middleware(['auth:sanctum']);
 
 Route::apiResource('functions',App\Http\Controllers\FunctionController::class)->middleware(['auth:sanctum']);
 
 Route::apiResource('anuencias',App\Http\Controllers\AnuenciaController::class)->middleware(['auth:sanctum']);