<?php

use Illuminate\Support\Facades\Route;
use 

# Importando o EventController
App\Http\Controllers\EventController;

############## Routes ###############

Route::get('/', [EventController::Class, 'index']);
Route::get('/events/create', [EventController::Class, 'create']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/event/{id}', [EventController::class, 'show']);
