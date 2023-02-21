<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//rotas da primeira versão
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('pacotes', PacoteController::class);
});

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('cadastro', [App\Http\Controllers\AuthController::class, 'cadastro']);
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
