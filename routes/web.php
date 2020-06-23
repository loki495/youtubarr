<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\YoutubeController;

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

Route::post('/download', [YoutubeController::class,'download'])->name('videos.download');
Route::get('/search/{keywords?}', [YoutubeController::class,'search'])->name('videos.search');
Route::post('/search', [YoutubeController::class,'search'])->name('videos.search');
Route::get('/', [YoutubeController::class,'index'])->name('videos.home');
