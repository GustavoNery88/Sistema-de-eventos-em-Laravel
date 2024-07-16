<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventosController;

Route::get('/',  [EventosController::class, 'index']);

Route::get('/eventos/criar',  [EventosController::class, 'criar'])->middleware('auth');
Route::get('/eventos/{id}', [EventosController::class, 'show'])->name('eventos.show');
Route::post('/eventos',  [EventosController::class, 'store']);
Route::get('/dashboard', [EventosController::class, 'dashboard'])->middleware('auth');
Route::delete('/eventos/{id}', [EventosController::class, 'destroy'])->middleware('auth');
Route::get('/eventos/{id}/edit', [EventosController::class, 'edit'])->middleware('auth'); 
Route::put('/eventos/{id}', [EventosController::class, 'update'])->middleware('auth'); 
Route::post('/eventos/join/{id}', [EventosController::class, 'joinEvent'])->middleware('auth');
Route::delete('/eventos/leave/{id}', [EventosController::class, 'leaveEvent'])->middleware('auth');
