<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ContactController;
use GuzzleHttp\Middleware;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('wavecofee', [SiteController::class, 'drinks'])->name('drinks');

////////////////////////////////////////////////////////////////////////////////////

Auth::routes(['verify' => true]);
Route::prefix('admin')->middleware('verified')->group(function () {

Route::get('users', [UsersController::class, 'index'])->name('users');
Route::get('addUser', [UsersController::class, 'create']);
Route::post('addUser', [UsersController::class, 'store'])->name('addUser');
Route::get('editUser/{id}', [UsersController::class, 'edit'])->name('editUser');
Route::put('updateUser/{id}', [UsersController::class, 'update'])->name('updateUser');

///////////////////////////Categories////////////////////////////////////////////////////////////////////

Route::get('categories',[CategoriesController::class,'index'])->name('categories');
Route::get('addCategory', [CategoriesController::class, 'create']);
Route::post('addCategory', [CategoriesController::class, 'store'])->name('addCategory');
Route::get('editCategory/{id}', [CategoriesController::class, 'edit'])->name('editCategory');
Route::put('updateCategory/{id}', [CategoriesController::class, 'update'])->name('updateCategory');
Route::delete('delCategory/{id}', [CategoriesController::class, 'destroy'])->name('delCategory');

/////////////////////////////Beverages///////////////////////////////////////////////////////////////////

Route::get('beverages',[BeverageController::class,'index'])->name('beverages');
Route::get('addBeverage', [BeverageController::class, 'create']);
Route::post('addBeverage', [BeverageController::class, 'store'])->name('addBeverage');
Route::get('editBeverage/{id}', [BeverageController::class, 'edit'])->name('editBeverage');
Route::put('updateBeverage/{id}', [BeverageController::class, 'update'])->name('updateBeverage');
Route::delete('delBeverage/{id}',[BeverageController::class,'destroy'])->name('delBeverage');

///////////////////////contact us emails/////////////////////////////////////////////////////////////////

Route::get('messages', [ContactController::class, 'index'])->name('messages');
Route::get('showMessage/{id}', [ContactController::class, 'show'])->name('showMessage');
Route::delete('delMessage/{id}',[ContactController::class,'destroy'])->name('delMessage');
});

Route::post('contact', [ContactController::class, 'storeAndSend'])->name('contact');
Route::get('showContact', [ContactController::class, 'showContact']);