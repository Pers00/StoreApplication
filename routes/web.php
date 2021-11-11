<?php

use Illuminate\Support\Facades\Route;

// Para usar nuestro Index controlador
use App\Http\Controllers\IndexController;

// Para usar nuestro resource controlador
use App\Http\Controllers\ResourceController;

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

// ruta a nuestro controlador index
Route::get('/', [IndexController::class, 'index'])->name('index');

// ruta a nuestro controlador de recursos
Route::resource('store',ResourceController::class, ['names'=>'resource']);

//delete y no get para borrarlo con action (modal)
Route::delete('store/flush/all', [ResourceController::class, 'flush'])->name('store.flush');