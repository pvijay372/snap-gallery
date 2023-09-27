<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/galleries', [GalleryController::class, 'index']);
Route::post('/galleries', [GalleryController::class, 'store']);
Route::get('/galleries/show/{gallery}', [GalleryController::class, 'show']);
Route::patch('/galleries/{gallery}', [GalleryController::class, 'update']);

Route::get('/images/{gallery}', [ImageController::class, 'index']);
Route::post('/images', [ImageController::class, 'store']);
