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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/team/create', [App\Http\Controllers\PokemonController::class, 'create']);
Route::post('/team/create', [App\Http\Controllers\PokemonController::class, 'populate']);

Route::get('/team/list', [App\Http\Controllers\PokemonController::class, 'list']);
Route::post('/team/list', [App\Http\Controllers\PokemonController::class, 'list']);

Route::get('/team/{team_id}/edit', [App\Http\Controllers\PokemonController::class, 'edit']);
Route::post('/team/{team_id}/edit', [App\Http\Controllers\PokemonController::class, 'editName']);
