<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ViaCepController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/contatos", [ContatoController::class, 'index']);
Route::get("/contato/{id}", [ContatoController::class, 'show']);
Route::get("/cep/{cep}", [ViaCepController::class, 'show']);
Route::get("/ufs", [CidadeController::class, 'pegarUFs']);
Route::get("/cidades/{uf}/{texto}", [CidadeController::class, 'pegarCidades']);

Route::post("/contato", [ContatoController::class, 'store']);
Route::put("/contato/{request}/{id}", [ContatoController::class, 'update']);
Route::delete("/contato/{id}", [ContatoController::class, 'destroy']);
