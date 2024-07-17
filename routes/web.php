<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\SiteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('dash/test');
});

Route::get('test1', function () {
    return view('test1');
});


// Route::prefix('cofee')->group(function () {
Route::get('wavecofee', [HomeController::class, 'drinks'])->name('drinks');
// Route::get('about', [SiteController::class, 'about'])->name('about');
// Route::get('special', [SiteController::class, 'specials'])->name('special');
// Route::get('contact', [SiteController::class, 'contact'])->name('contact');
// });


// Route::prefix('admin')->group(function () {
// Route::get('login', [UsersController::class, 'registrationforms'])->name('test');
// Route::post('register',[UsersController::class,'store'])->name('signup');
// Route::post('login',[UsersController::class,'login'])->name('signin');
// Route::post('logout',[UsersController::class,'logout'])->name('logout');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Route::get('users',[UsersController::class,'index'])->name('users');

// });

Auth::routes();

Route::get('users', [HomeController::class, 'index'])->name('users');

Route::get('addUser', [UsersController::class, 'create']);
Route::post('addUser', [UsersController::class, 'store'])->name('addUser');
Route::get('editUser/{id}', [UsersController::class, 'edit'])->name('editUser');
Route::put('updateUser/{id}', [UsersController::class, 'update'])->name('updateUser');
///////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('categories',[CategoriesController::class,'index'])->name('categories');
Route::get('addCategory', [CategoriesController::class, 'create']);
Route::post('addCategory', [CategoriesController::class, 'store'])->name('addCategory');
Route::get('editCategory/{id}', [CategoriesController::class, 'edit'])->name('editCategory');
Route::put('updateCategory/{id}', [CategoriesController::class, 'update'])->name('updateCategory');
Route::delete('delCategory/{id}', [CategoriesController::class, 'destroy'])->name('delCategory');
////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('beverages',[BeverageController::class,'index'])->name('beverages');
Route::get('addBeverage', [BeverageController::class, 'create']);
Route::post('addBeverage', [BeverageController::class, 'store'])->name('addBeverage');
Route::get('editBeverage/{id}', [BeverageController::class, 'edit'])->name('editBeverage');
Route::put('updateBeverage/{id}', [BeverageController::class, 'update'])->name('updateBeverage');
Route::delete('delBeverage/{id}',[BeverageController::class,'destroy'])->name('delBeverage');