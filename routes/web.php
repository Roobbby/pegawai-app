<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EmployeController::class, 'dashboard'])->name('dashboard');
Route::resource('employe', EmployeController::class);
Route::post('/employe/upload-photo', [EmployeController::class, 'uploadPhoto'])->name('employe.uploadPhoto');
Route::post('/upload', [EmployeController::class, 'upload'])->name('dropzone.store');
Route::get('/dropzone',[EmployeController::class, 'drop'])->name('drop');
