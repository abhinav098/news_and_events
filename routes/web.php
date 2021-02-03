<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProveventer within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Routes for news
Route::resource('news', NewsController::class);
// Route::get('/news', [NewsController::class, 'index'])->name('news');
// Route::get("/news/new", [NewsController::class, 'create']);
// Route::post("/news", [NewsController::class, 'store']);
// Route::get("/news/{id}/edit", [NewsController::class, 'edit']);
// Route::put("/news/{id}", [NewsController::class, 'update']);
// Route::get("/news/{id}", [NewsController::class, 'show'])->name('article_path');

// Routes for events
Route::resource('events', EventsController::class);
