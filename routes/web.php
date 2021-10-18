<?php

use Illuminate\Support\Facades\Route;
//dashboard
use App\Http\Controllers\Dashboard\DashBoardController;

//user management start here
    /********* */
use App\Http\Controllers\Backend\Users\UserController;

//setup management start here
    /********* */
//student class controller
use App\Http\Controllers\Backend\Setup\StudentClassController;
//student year controller
use App\Http\Controllers\Backend\Setup\StudentYearController;
//student shift controller
use App\Http\Controllers\Backend\Setup\StudentShiftController;
//student group controller
use App\Http\Controllers\Backend\Setup\StudentGroupController;
//student fee category controller
use App\Http\Controllers\Backend\Setup\StudentFeeCategoryController;
//student fee category amount controller
use App\Http\Controllers\Backend\Setup\StudentFeeAmountController;
//student exam type controller
use App\Http\Controllers\Backend\Setup\StudentExamTypeController;
//student exam type controller
use App\Http\Controllers\Backend\Setup\StudentSubjectController;
//student assign subject controller
use App\Http\Controllers\Backend\Setup\StudentAssignSubjectController;
//designation controller
use App\Http\Controllers\Backend\Setup\DesignationController;

//students controller start here
    /********* */
//Student registration controller
use App\Http\Controllers\Backend\Students\StudentRegistrationController;
//Student Roll Generate Controller
use App\Http\Controllers\Backend\Students\StudentRollGenerateController;


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
    return view('welcome');
});

 Route::group(['prefix'=>'admin'], function(){ 
     //dashboard 
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');

    //user management
    Route::resource('user',UserController::class);
   
    //profile management
    //it will also created after creating setup management

    //setup management
    Route::group(['prefix'=>'setup'], function(){ 
        //student class 
        Route::resource('student-class',StudentClassController::class);
        //student year
        Route::resource('student-year',StudentYearController::class);
        //student shift
        Route::resource('student-shift',StudentShiftController::class);
        //student group
        Route::resource('student-group',StudentGroupController::class);
        //student fee
        Route::resource('student-fee',StudentFeeCategoryController::class);
        //student fee amount
        Route::resource('student-fee-amount',StudentFeeAmountController::class);
        //student exam type
        Route::resource('student-exam',StudentExamTypeController::class);
        //student subject name
        Route::resource('student-subject',StudentSubjectController::class);
        //student assign subject 
        Route::resource('student-assign-subject',StudentAssignSubjectController::class);
        //designation 
        Route::resource('designation',DesignationController::class);
    });

    //students management start here
    Route::group(['prefix'=>'students'], function(){ 
        //student registration 
        Route::resource('student-registration',StudentRegistrationController::class);
        Route::get('search',[StudentRegistrationController::class,'searchedStudent'])->name('year.class.wise.search.student');
        Route::get('promotion/{student_id}',[StudentRegistrationController::class,'promotionStudent'])->name('promotion.student');
        Route::post('promotion/store/{student_id}',[StudentRegistrationController::class,'promotionStoreStudent'])->name('promotion.store.student');
        Route::get('pdf/{student_id}',[StudentRegistrationController::class,'studentPdfFile'])->name('student.pdf');

        //student roll generate 
        Route::resource('roll-generate', StudentRollGenerateController::class);
        Route::get('get-student',[StudentRollGenerateController::class,'getStudent'])->name('roll-generate.getStudent');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
