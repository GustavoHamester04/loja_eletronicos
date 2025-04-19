<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('cidades', CidadeController::class);

