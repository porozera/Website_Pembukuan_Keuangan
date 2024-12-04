<?php

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {

	// Debt (hutang)
	Route::get('/debt', [DebtController::class, 'index'])->name('debt');
	Route::get('/debt/add', [DebtController::class, 'add'])->name('debt.add');
	Route::post('/debt/add/perform', [DebtController::class, 'create'])->name('debt.add.perform');
	Route::get('/debt/edit/{id}', [DebtController::class, 'edit'])->name('debt.edit');
	Route::put('/debt/edit/{id}/perform', [DebtController::class, 'update'])->name('debt.edit.perform');
	Route::delete('/debt/delete/{id}', [DebtController::class, 'delete'])->name('debt.delete');

	// Products
	Route::get('/product', [ProductController::class, 'index'])->name('product');
	Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
	Route::post('/product/add/perform', [ProductController::class, 'create'])->name('product.add.perform');
	Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
	Route::put('/product/edit/{id}/perform', [ProductController::class, 'update'])->name('product.edit.perform');
	Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

	// Karyawan
	Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
	Route::get('/karyawan/add', [KaryawanController::class, 'add'])->name('karyawan.add');
	Route::post('/karyawan/add/perform', [KaryawanController::class, 'create'])->name('karyawan.add.perform');
	Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
	Route::put('/product/edit/{id}/perform', [KaryawanController::class, 'update'])->name('karyawan.edit.perform');
	Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'delete'])->name('karyawan.delete');



	// NAMBAH ROUTE DIATAS LINE INI AJAAA!!!!
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	Route::get('/{page}', [PageController::class, 'index'])->name('page');

});