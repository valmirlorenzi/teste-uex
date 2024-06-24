<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contatos', function () {
    return view('contatos');
})->middleware(['auth', 'verified'])->name('contatos');

Route::middleware('auth')->group(function () {
    Route::get('/lista-contatos', [ContatoController::class, 'lista'])->name('contatos.lista');
    Route::get('/visualizacao-contatos', [ContatoController::class, 'visualizacao'])->name('contatos.visualizacao');
    //Route::get('/ler-contato', [ContatoController::class, 'show'])->name('contatos.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


