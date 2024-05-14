<?php

use Illuminate\Support\Facades\Route;

############## Routes ###############

Route::get('/', function () {
    return view('welcome');
});
