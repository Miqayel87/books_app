<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

Route::group(['prefix' => 'book'], function () {
    Route::post('/create', [BookController::class, 'create'])->name('book.create');
    Route::put('/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
    Route::post('/search', [BookController::class, 'search'])->name('book.search');
});

Route::group(['prefix' => 'author'], function () {
    Route::post('/create', [AuthorController::class, 'create'])->name('author.create');
    Route::put('/update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
});
