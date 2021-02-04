<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\api\NewsController as NewsApiController;
use App\Http\Controllers\api\EventsController as EventsApiController;


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
Route::get('/api/news', [NewsApiController::class, 'index']);
Route::get('/api/news/search', [NewsApiController::class, 'search']);
Route::get('/api/news/{id}', [NewsApiController::class, 'show']);

// Route::get("/news/new", [NewsController::class, 'create']);
// Route::post("/news", [NewsController::class, 'store']);
// Route::get("/news/{id}/edit", [NewsController::class, 'edit']);
// Route::put("/news/{id}", [NewsController::class, 'update']);
// Route::get("/news/{id}", [NewsController::class, 'show'])->name('article_path');

// Routes for events
Route::resource('events', EventsController::class);
Route::get('/api/events', [EventsApiController::class, 'index']);
Route::get('/api/events/search', [EventsApiController::class, 'search']);
Route::get('/api/events/{id}', [EventsApiController::class, 'show']);
