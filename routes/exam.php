<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamApiController;

//Route::resource('exam',App\Http\Controllers\Api\ExamApiController::class);
// to get all exams with its questions
Route::get('exams', [App\Http\Controllers\Api\ExamApiController::class,'index']);
//to get exam by id
Route::get('exams/{exam}', [App\Http\Controllers\Api\ExamApiController::class,'show']);
// to add an exam with its questions
Route::post('exams', [App\Http\Controllers\Api\ExamApiController::class,'store']);
// to update exam by exam id
Route::put('exams/{exam}', [App\Http\Controllers\Api\ExamApiController::class,'update']);
//to delete exam by exam id
Route::delete('exams/{exam}', [App\Http\Controllers\Api\ExamApiController::class,'destroy']);
