<?php

use App\Http\Controllers\V1\CategoriaController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rotas da primeira versão
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'],function(){
    Route::apiResource('categorias',CategoriaController::class);
    Route::apiResource('produtos',ProdutoController::class);
    Route::apiResource('pacotes',PacoteController::class);
});