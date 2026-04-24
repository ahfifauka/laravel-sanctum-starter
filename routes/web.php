<?php

use App\Http\Controllers\Api\AuthenticatedController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthenticatedController::class, 'login']);
Route::delete('/logout', [AuthenticatedController::class, 'logout']);
