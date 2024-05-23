<?php

use Illuminate\Support\Facades\Route;
use 

# Importando o EventController
App\Http\Controllers\EventController;

############## Routes ###############

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/event/{id}', [EventController::class, 'show']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

