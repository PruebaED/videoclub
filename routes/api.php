<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PeliculaController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('peliculas', PeliculaController::class);

Route::get('peliculas/search/{search}', [PeliculaController::class, 'search'])->name('peliculas.search');

Route::post('peliculas/newOMDB/{idFilm}', [PeliculaController::class, 'storeOMDB']);
