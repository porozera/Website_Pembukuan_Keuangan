<?php

use App\Http\Controllers\AccountController;
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
use App\Http\Controllers\Debts_ReceivablesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\HppcalculationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;


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
	Route::get('/debt_receivable', [Debts_ReceivablesController::class, 'index'])->name('debt_receivable');
	Route::get('/debt_receivable/add', [Debts_ReceivablesController::class, 'add'])->name('debt_receivable.add');
	Route::post('/debt_receivable/add/perform', [Debts_ReceivablesController::class, 'create'])->name('debt_receivable.add.perform');
	Route::get('/debt_receivable/edit/{id}', [Debts_ReceivablesController::class, 'edit'])->name('debt_receivable.edit');
	Route::post('/debt_receivable/{id}/payment', [Debts_ReceivablesController::class, 'payment'])->name('debt_receivable.payment');
	Route::delete('/debt_receivable/delete/{id}', [Debts_ReceivablesController::class, 'delete'])->name('debt_receivable.delete');

	// Payment
	Route::delete('/payment/delete/{id}',[Debts_ReceivablesController::class, 'deletePayment'])->name('payment.delete');

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
	Route::put('/karyawan/edit/{id}/perform', [KaryawanController::class, 'update'])->name('karyawan.edit.perform');
	Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'delete'])->name('karyawan.delete');

	//hpp
	Route::get('/hpp', [HppcalculationController::class, 'index'])->name('hpp');
	Route::get('/hpp/add', [HppcalculationController::class, 'add'])->name('hpp.add');
	Route::post('/hpp/add/perform', [HppcalculationController::class, 'create'])->name('hpp.add.perform');
	Route::get('/hpp/detail/{id}', [HppcalculationController::class, 'detail'])->name('hpp.detail');
	Route::get('/hpp/edit/{id}', [HppcalculationController::class, 'edit'])->name('hpp.edit');
	Route::put('/hpp/edit/{id}/perform', [HppcalculationController::class, 'update'])->name('hpp.edit.perform');
	Route::delete('/hpp/delete/{id}', [HppcalculationController::class, 'delete'])->name('hpp.delete');

	// Transactions
	Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
	Route::get('/transaction/add', [TransactionController::class, 'add'])->name('transaction.add');
	Route::post('/transaction/add/perform', [TransactionController::class, 'create'])->name('transaction.add.perform');
	Route::get('/transaction/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
	Route::put('/transaction/edit/{id}/perform', [TransactionController::class, 'update'])->name('transaction.edit.perform');
	Route::delete('/transaction/delete/{id}', [TransactionController::class, 'delete'])->name('transaction.delete');

	// Account
	Route::get('/account', [AccountController::class, 'index'])->name('account');
	Route::get('/account/add', [AccountController::class, 'add'])->name('account.add');
	Route::post('/account/add/perform', [AccountController::class, 'create'])->name('account.add.perform');
	Route::get('/account/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
	Route::put('/account/edit/{id}/perform', [AccountController::class, 'update'])->name('account.edit.perform');
	Route::delete('/account/delete/{id}', [AccountController::class, 'delete'])->name('account.delete');

	// Report
	Route::get('/report', [ReportController::class, 'index'])->name('report');
	Route::get('/report/jurnal', [ReportController::class, 'jurnal'])->name('reports.jurnal');

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