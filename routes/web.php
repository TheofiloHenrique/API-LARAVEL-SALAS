<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('theo');
});

Route::get('/aula1', [AulaController::class, 'aula1']);
