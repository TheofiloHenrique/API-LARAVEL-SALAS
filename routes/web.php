<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\TurmaSalaController;

Route::prefix('turmas')->group(function () {
    Route::post('/', [TurmaController::class, 'criar']);

    Route::get('/', [TurmaController::class, 'listar']);

    Route::get('/{codigo}', [TurmaController::class, 'ocupacaoPorCodigo']);

    Route::get('/{id}', [TurmaController::class, 'listarPorId']);

    Route::patch('/{id}', [TurmaController::class, 'atualizar']);

    Route::delete('/{id}', [TurmaController::class, 'deletar']);

});

Route::prefix('salas')->group(function () {
    Route::post('/', [SalaController::class, 'criar']);

    Route::get('/', [SalaController::class, 'listar']);

    Route::get('/{numero_sala}', [SalaController::class, 'ocupacaoPorData']);

    Route::get('/{id}', [SalaController::class, 'listarPorId']);

    Route::patch('/{id}', [SalaController::class, 'atualizar']);

    Route::delete('/{id}', [SalaController::class, 'deletar']);
});

Route::prefix('turmaSalas')->group(function () {
    Route::post('/', [TurmaSalaController::class, 'criar']);

    Route::get('/', [TurmaSalaController::class, 'listar']);

    Route::get('/{codigo}', [TurmaSalaController::class, 'buscarPorCodigo']);

    Route::get('/{id}', [TurmaSalaController::class, 'listarPorId']);

    Route::patch('/{id}', [TurmaSalaController::class, 'atualizar']);

    Route::delete('/{id}', [TurmaSalaController::class, 'deletar']);
});


