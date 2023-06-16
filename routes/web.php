<?php

use App\Http\Controllers\HeadmasterController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ToyyibPayController;
use App\Http\Controllers\UserController;
use App\Models\Headmasters;
use App\Models\Students;
use Database\Seeders\TeacherSeeder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing 
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

//---------------------------STUDENTS----------------------------------//
// index - all students
Route::get('/students/list', [StudentController::class, 'index']);

// create - student registration form
Route::get('/students/registration', [StudentController::class, 'create']); 

// store - student data
Route::post('/students', [StudentController::class, 'store']);

// show - edit student detail profile
Route::get('/students/{student}/edit', [StudentController::class, 'edit']);

// edit - submit update student detail profile
Route::put('/students/{students}', [StudentController::class, 'update']);

// show - update student status
Route::get('/students/approval', [StudentController::class, 'approval']);

// update - modified student status form pending to approved
Route::put('/students/{student}/approve', [StudentController::class, 'approve'])->name('students.approve');

// update - modified student status from pending to rejected
Route::put('/students/{student}/reject', [StudentController::class, 'reject'])->name('students.reject');

//index - show student learning progress
Route::get('/students/learning-progress/{students}', [StudentController::class, 'learning']);

//index - show student learning progress as parent 
Route::get('/students/view-learning-progress/{student}', [StudentController::class, 'viewLearning'])->name('students.view-learning-progress');

//index - show student application status as parent
Route::get('/students/approval/{student}', [StudentController::class, 'approvalStatus'])->name('students.approval');

// store - student learning progress data
Route::post('/students/learning-progress', [StudentController::class, 'addLearningProgress']);

//index - show student learning progress
Route::get('/students/learning-progress-list', [StudentController::class, 'learningList']);

// delete - delete student detail profile
Route::delete('/students/{students}', [StudentController::class, 'destroy']);

// show - student detail profile
Route::get('/students/{student}', [StudentController::class, 'show']);

//show - student payment details
Route::get('/students/fee-payment/{student}', [StudentController::class, 'payment'])->name('students.fee-payment');

//show - student payment checkout
Route::get('/students/payment/checkout/{student}/{invoice_id}', [StudentController::class, 'paymentCheckout'])->name('students.payment-checkout');

//generate invoice 
Route::get('/students/generate-receipt/{studentId}/{invoiceId}', [StudentController::class, 'generateReceipt'])->name('students.generate-receipt');

//------------------------TOYYIBPAY PAYMENT----------------------------//
Route::get('/students/payment/checkout/{student}/{invoice_id}/toyyibpay', [ToyyibPayController::class, 'createBill'])->name('students.toyyibpay');
Route::get('/students/payment/checkout/toyyibpay-status', [ToyyibPayController::class, 'paymentStatus'])->name('students.toyyib-status');
Route::post('/students/toyyibpay-callback', [ToyyibPayController::class, 'callBack'])->name('students.toyyib-callback');

//-----------------------------USERS-----------------------------------//
// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
});

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//edit - user password
Route::put('/users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');


//-----------------------------PARENTS-----------------------------------//
// index - all parent
Route::get('/parents/list', [ParentsController::class, 'index']);

//show - edit user profile 
Route::get('/parents/{parent}/edit-user-profile', [ParentsController::class, 'editProfile'])->name('parents.edit-profile');

// show - edit student detail profile
Route::get('/parents/{parent}/edit', [ParentsController::class, 'edit'])->name('parents.edit');

// edit - submit update student detail profile
Route::put('/parents/{parents}', [ParentsController::class, 'update'])->name('parents.update');
Route::post('/parents/{parent}', [ParentsController::class, 'update'])->name('parents.update');

//edit - edit image for parent 
Route::put('/parents/upload-photo/{parent}', [ParentsController::class, 'uploadPhoto'])->name('parents.uploadPhoto');

// show - student detail profile
Route::get('/parents/{parent}', [ParentsController::class, 'show']);

// delete - delete parent detail profile
Route::delete('/parents/{parents}', [ParentsController::class, 'destroy']);


//-----------------------------TEACHERS-----------------------------------//
// index - all teacher
Route::get('/teachers/list', [TeacherController::class, 'index']);

// show - teacher detail profile
Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);

// Edit teacher detail profile
Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');

// Submit update teacher detail profile
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');

//show - edit user profile 
Route::get('/teachers/{teacher}/edit-user-profile', [TeacherController::class, 'editProfile'])->name('teachers.edit-profile');;

//edit - edit image for teacher 
Route::put('/teachers/upload-photo/{teachers}', [TeacherController::class, 'uploadPhoto'])->name('teachers.uploadPhoto');

// delete - delete teacher detail profile
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy']);


//-----------------------------STAFF-----------------------------------//
// index - all staff
Route::get('/staffs/list', [StaffController::class, 'index'])->middleware('customauth');

// show - staff detail profile
Route::get('/staffs/{staff}', [StaffController::class, 'show']);

// Edit staff detail profile
Route::get('/staffs/{staff}/edit', [StaffController::class, 'edit'])->name('staffs.edit');

// Submit update staff detail profile
Route::put('/staffs/{staff}', [StaffController::class, 'update'])->name('staffs.update');

//show - edit user profile 
Route::get('/staffs/{staff}/edit-user-profile', [StaffController::class, 'editProfile'])->name('staffs.edit-profile');

//edit - edit image for staff 
Route::put('/staffs/upload-photo/{stafff}', [StaffController::class, 'uploadPhoto'])->name('staffs.uploadPhoto');

// delete - delete staff detail profile
Route::delete('/staffs/{staff}', [StaffController::class, 'destroy']);


//--------------------------HEADMASTER-------------------------------//
// Edit headmaster detail profile
Route::get('/headmaster/{headmaster}/edit', [HeadmasterController::class, 'edit'])->name('headmasters.edit');

// Submit update headmaster detail profile
Route::put('/headmaster/{headmaster}', [HeadmasterController::class, 'update'])->name('headmasters.update');

//show - edit user profile 
Route::get('/headmaster/{headmaster}/edit-user-profile', [HeadmasterController::class, 'editProfile'])->name('headmasters.edit-profile');;

//edit - edit image for headmaster 
Route::put('/headmaster/upload-photo/{headmaster}', [HeadmasterController::class, 'uploadPhoto'])->name('headmasters.uploadPhoto');

// delete - delete headmaster detail profile
Route::delete('/headmaster/{headmaster}', [HeadmasterController::class, 'destroy']);