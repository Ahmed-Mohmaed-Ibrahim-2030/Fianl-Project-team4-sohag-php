<?php

//use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorsSupportController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('profile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//Route::resource('course', App\Http\Controllers\courseController::class);
Route::resource('courseContents', App\Http\Controllers\CourseContentController::class);
Route::resource('offers', App\Http\Controllers\OfferController::class);
//Route::resource('coursestudent', App\Http\Controllers\CourseStudentController::class);
//Route::resource('category', App\Http\Controllers\categoryController::class);
//Route::resource('subcategory', App\Http\Controllers\subCategoryController::class);

Route::get('profile',function(){
    return view('adminDashboard.users.profile');
})->name('profile')->middleware('auth');

require __DIR__.'/auth.php';
require __DIR__.'/users.php';

require __DIR__ . '/categories.php';

//Route::resource('course', App\Http\Controllers\courseController::class);
//Route::resource('courseContents', App\Http\Controllers\CourseContentController::class);
Route::resource('offers', App\Http\Controllers\OfferController::class);

//Route::resource('coursestudent', App\Http\Controllers\CourseStudentController::class);
//Route::resource('category', App\Http\Controllers\categoryController::class);

Route::resource('coursestudent', App\Http\Controllers\CourseStudentController::class);
Route::resource('category', App\Http\Controllers\categoryController::class);

//Route::resource('subcategory', App\Http\Controllers\subCategoryController::class);


require __DIR__.'/auth.php';
//require __DIR__.'/notifications.php';


//Route::controller(AdminsController::class)->group(function () {
//    Route::get('admins/create', 'create');
//    Route::get('admins/index', 'index');
//    Route::get('admins/edit/{id}', 'edit');
//    Route::get('admins/update/{id}', 'update');
//    Route::get('admins/delete/{id}', 'delete');
//});

Route::controller(AccountsController::class)->group(function () {
    Route::get('accounts/create', 'create');
    Route::get('accounts/index', 'index');
    Route::get('accounts/edit/{id}', 'edit');
    Route::get('accounts/update/{id}', 'update');
    Route::get('accounts/delete/{id}', 'delete');

});

Route::controller(ParentsController::class)->group(function () {
    Route::get('parents/create', 'create');
    Route::get('parents/index', 'index');
    Route::get('parents/edit/{id}', 'edit');
    Route::get('parents/update/{id}', 'update');
    Route::get('parents/delete/{id}', 'delete');

});

//Route::controller(InstructorController::class)->group(function () {
//    Route::get('instructors/create', 'create');
//    Route::get('instructors/index', 'index');
//    Route::get('instructors/edit/{id}', 'edit');
//    Route::get('instructors/update/{id}', 'update');
//    Route::get('instructors/delete/{id}', 'delete');
//
//});

Route::controller(InstructorsSupportController::class)->group(function () {
    Route::get('instructors_support/create', 'create');
    Route::get('instructors_support/index', 'index');
    Route::get('instructors_support/edit/{id}', 'edit');
    Route::get('instructors_support/update/{id}', 'update');
    Route::get('instructors_support/delete/{id}', 'delete');
});



//Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
//Route::get('categories', [CategoryController::class, 'allCategories'])->name('allCategories');
//Route::any('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');
//Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');



Route::get('/courses', [courseController::class, 'index'])->name("allcourses")->middleware('auth');
Route::get('/courses/create', [courseController::class, 'create'])->name("create.course")->middleware('auth');
Route::post('/courses/store', [courseController::class, 'store'])->name("course.store")->middleware('auth');
Route::get('/courses/video/create/{course}', [CourseContentController::class, 'create'])->name("course.video.create")->middleware('auth');
Route::get('/courses/video/show/{course}', [CourseContentController::class, 'show'])->name("course.video.show")->middleware('auth');
Route::post('/courses/video/store', [CourseContentController::class, 'store'])->name("course.video.store");
Route::get('/courses/category', [CategoryController::class, 'index'])->name("allCategories");
Route::get('/courses/category/create', [CategoryController::class, 'create'])->name("create.category");
Route::post('/courses/category/store', [CategoryController::class, 'store'])->name("category.store");
// Route::get('categories', [CategoryController::class, 'allCategories'])->name('allCategories');
// Route::any('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');
// Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');

Route::resource('Category',App\Http\Controllers\Category\CategoryController::class)->middleware('auth');

Route::resource('Students',\App\Http\Controllers\StudentController::class);
Route::resource('StudentsSupport',\App\Http\Controllers\StudentSupportController::class);
Route::resource('exam',\App\Http\Controllers\ExamController::class);
//Route::resource('examContetn',\App\Http\Controllers\ExamContentController::class);
Route::resource('certification',\App\Http\Controllers\CertificationController::class);
Route::resource('StudentExam',\App\Http\Controllers\StudentExamController::class);


//Route::get('stripe', [StripePaymentController::class,'stripe']);
//Route::post('stripe', [StripePaymentController::class,'stripePost'])->name('stripe.post');
//
//Route::get('stripe', [StripePaymentController::class,'stripe']);
//Route::post('stripe', [StripePaymentController::class,'stripePost'])->name('stripe.post');

Route::resource('exams',App\Http\Controllers\ExamController::class)->middleware('auth');
Route::get('addQuestion/{exam}',[App\Http\Controllers\ExamController::class,'addQuestion'])->name('exams.addQuestion')->middleware('auth');
Route::post('storeQuestion/{exam}',[App\Http\Controllers\ExamController::class,'storeQuestion'])->name('exams.storeQuestion')->middleware('auth');
Route::delete('question/{exam}',[App\Http\Controllers\ExamController::class,'destroyQuestion'])->name('question.destroy')->middleware('auth');

Route::post('questionsCount',[\App\Http\Controllers\ExamController::class,'questionsCount'])->name('questionsCount');

Route::get('/contact-form', [App\Http\Controllers\Api\ContactUsFormController::class, 'contactForm'])->name('contact-form')->middleware('auth');
//Route::get('stripe', [StripePaymentController::class,'stripe']);
//Route::post('stripe', [StripePaymentController::class,'stripePost'])->name('stripe.post');
