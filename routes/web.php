<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\TurmaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('theo');
});

Route::get('/aula1', [AulaController::class, 'aula1']);

Route::get('/turma-cadastro', [TurmaController::class, 'cadastro']);

Route::get('/turma-listar', [TurmaController::class, 'listar']);

Route::get('/turma-listar/{id}', [TurmaController::class, 'listarId']);

Route::get('/turma-alterar/{id}/{name}', [TurmaController::class, 'alterar']);

Route::get('/turma-deletar/{id}', [TurmaController::class, 'deletar']);




