<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Category\SubCategoryController;
use App\Http\Controllers\Api\Course\CourseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('category', CategoryController::class);
//get subCategories by Category id
Route::get('getSubCategoriesByCategoryId/{Category_id}', [CategoryController::class,'getSubCategories']);
//subcategory resource index,show,...
Route::resource('subcategory', SubCategoryController::class);
// get courses by sucat id
Route::get('getCourseBySubCategoryId/{SubCategory_id}', [SubCategoryController::class,'getCourses']);
// courses resource index,show,....
Route::resource('course', CourseController::class);
// search by course name
Route::get('getCourses/{course_name}', [CourseController::class,'getCoursesByName']);
// get the average rate of course by its id
Route::get('getRates/{course_id}', [CourseController::class,'avrageRate']);
// get the rates and comments   of course by its id
Route::get('feedbacks/{course_id}', [CourseController::class,'feedbacks']);
// get limit top rated courses
Route::get('getTopRated/{limit}', [CourseController::class,'getTopRated']);
