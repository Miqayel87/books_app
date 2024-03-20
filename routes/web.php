<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
    Route::middleware('admin')->resource('books', BookController::class)->only(['create', 'store', 'update', 'edit', 'destroy']);
    Route::middleware('admin')->resource('authors', AuthorController::class)->only(['create', 'store', 'update', 'edit', 'destroy']);
    Route::get('/', function (){
        return redirect()->route('books.index');
    });
    Route::group(['prefix' => 'book'], function () {
        Route::get('/search', [BookController::class, 'search'])->name('book.search');
    });
});

Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('auth');
Route::get('/unauthorized', function () {
    return response()->view('error.unauthorized');
})->name('unauthorized');
Route::fallback(function () {
    return response()->view('error.wrong_path', [], 404);
});







