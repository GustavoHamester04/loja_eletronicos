<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FotoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('cidades', CidadeController::class);
Route::resource('enderecos', EnderecoController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('vendas', VendaController::class);
Route::resource('categorias', CategoriaController::class)->middleware(['auth','admin']);
Route::resource('produtos',   ProdutoController::class)->middleware(['auth','admin']);
Route::resource('fotos',      FotoController::class)->middleware(['auth','admin']);
