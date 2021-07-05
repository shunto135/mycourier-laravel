<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/profile', [AdminController::class,'profile'])->name('admin.profile');
Route::put('/admin/profile', [AdminController::class,'updateProfile'])->name('admin.updateProfile');
Route::get('/admin/order/track', [AdminController::class,'orderHistory'])->name('admin.order.track');
Route::get('/admin/order/update/{order}', [AdminController::class,'editOrder'])->name('admin.order.edit');
Route::put('/admin/order/update/{order}', [AdminController::class,'updateOrderStatus'])->name('admin.order.update');


//User
Route::get('/user', [UserController::class,'index'])->name('user');
Route::get('/user/profile',[UserController::class,'profile'])->name('user.profile');
Route::put('/user/profile', [UserController::class,'updateProfile'])->name('user.updateProfile');
// User Order Request
Route::get('/user/order',[UserController::class,'order'])->name('user.order');
Route::put('/user/order',[UserController::class,'requestOrder'])->name('user.requestOrder');
Route::get('/user/order/track',[UserController::class,'trackOrder'])->name('user.order.track');
Route::get('/user/order/view/{id}',[UserController::class,'viewOrder'])->name('user.order.view');



//Employee
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
Route::put('/employee/profile', [EmployeeController::class, 'updateProfile'])->name('employee.updateProfile');

