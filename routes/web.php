<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index');

/*Route::get('login', function () {
    return view('auth.login');
});

Route::get('logout', function () {
    return view('auth.logout');
});*/

Route::group(['middleware' => 'auth'], function() {

	Route::get('catalog', 'App\Http\Controllers\CatalogController@getIndex');

	Route::get('catalog/show/{id}', 'App\Http\Controllers\CatalogController@getShow');

	Route::get('catalog/create', 'App\Http\Controllers\CatalogController@getCreate');
	Route::post('catalog/create', 'App\Http\Controllers\CatalogController@postCreate');

	Route::get('catalog/edit/{id}', 'App\Http\Controllers\CatalogController@getEdit');
	Route::put('catalog/edit', 'App\Http\Controllers\CatalogController@putEdit');

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Auth::routes();
