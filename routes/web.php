<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

############## Routes ###############

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.delete')->middleware('auth');
Route::get('events/edit/{id}', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update');

Route::get('/dashboard', [EventController::class, 'dashboard'])->name('events.dashboard')->middleware('auth');

Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->name('events.join')->middleware('auth');

Route::delete('/event/leave/{id}', [EventController::class, 'leaveEvent'])->name('events.leave')->middleware('auth');

Route::get('/auth/google', [AuthController::class, 'googleAuth'])->name('googleAuth');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);