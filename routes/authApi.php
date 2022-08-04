<?php

use Illuminate\Support\Facades\Route;

Route::post('student/login',[\App\Http\Controllers\Api\login\loginController::class,'login'])->middleware('CORS');
Route::post('student/create',[\App\Http\Controllers\Api\login\loginController::class,'registration']);