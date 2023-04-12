<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\SongController;
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

Route::name('genres.')->prefix('genres')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('list');
    Route::get('/read/{id}', [GenreController::class, 'show'])->name('show');
    Route::post('/create', [GenreController::class, 'store'])->name('store');
    Route::put('/update/{id}', [GenreController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [GenreController::class, 'destroy'])->name('destroy');
});

Route::name('songs.')->prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index'])->name('list');
    Route::get('/read/{id}', [SongController::class, 'show'])->name('show');
    Route::post('/create', [SongController::class, 'store'])->name('store');
    Route::put('/update/{id}', [SongController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [SongController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});