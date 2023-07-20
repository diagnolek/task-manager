<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'/task', 'middleware'=>'auth:sanctum'], function(){
    Route::get('/list', [\App\Http\Controllers\TaskController::class, 'tasks'])->name('task.list');
    Route::get('/list-done', [\App\Http\Controllers\TaskController::class, 'tasksDone'])->name('task.list-done');
    Route::post('/create', [\App\Http\Controllers\TaskController::class, 'store']);
    Route::put('/{id}',[\App\Http\Controllers\TaskController::class, 'update']);
    Route::get('/show/{id}', [\App\Http\Controllers\TaskController::class, 'show'])->name('task.show');
    Route::get('/delete/{id}',[\App\Http\Controllers\TaskController::class, 'destroy']);
});
