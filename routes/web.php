<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'/task', 'middleware'=>'auth'], function(){
    Route::get('/list', [\App\Http\Controllers\TaskController::class, 'index'])->name('task.list');
    Route::get('/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('task.create');
    Route::post('/create', [\App\Http\Controllers\TaskController::class, 'store']);
    Route::get('/{id}',[\App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
    Route::put('/{id}',[\App\Http\Controllers\TaskController::class, 'update']);
    Route::get('/show/{id}', [\App\Http\Controllers\TaskController::class, 'show'])->name('task.show');
    Route::get('/delete/{id}',[\App\Http\Controllers\TaskController::class, 'destroy'])->name('task.delete');
});
