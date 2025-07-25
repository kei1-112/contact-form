<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ModalController;

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
Route::middleware('auth')->group(function(){
    Route::get('/admin', [ContactController::class, 'admin']);
});
Route::get('/', [ContactController::class, 'index']);
Route::get('/search', [ContactController::class, 'search']);
Route::get('/export', [ContactController::class, 'export'])->name('admin.export');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/store', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);