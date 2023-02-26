<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\CarParkController;

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

Route::get('/', [CarParkController::class, 'index']);

Route::get('/login', [UserController::class, 'login_page']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);


Route::get('/register', [UserController::class, 'register_page']);
Route::post('/register', [UserController::class, 'register']);

Route::post('/input', [CarParkController::class, 'store']);
Route::post('/cost', [CarParkController::class, 'cost']);

Route::get('/record', [RecordController::class, 'index'])->middleware('admin');
Route::post('/record', [CarParkController::class, 'record'])->middleware('admin');
Route::get('/recordexport', [RecordController::class, 'record_export'])->middleware('admin');