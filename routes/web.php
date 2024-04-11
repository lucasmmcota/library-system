<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopiesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanTermController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('book', BookController::class);
    Route::resource('book_copies', BookCopiesController::class);
    Route::resource('loan', LoanController::class);
    Route::resource('loan_term', LoanTermController::class);
    Route::resource('member', MemberController::class);
    Route::resource('user', UserController::class);

    Route::post('/book_import', [BookController::class, 'import'])->name('book.import');
    Route::post('/member_import', [MemberController::class, 'import'])->name('member.import');

    Route::get('/generateTag/{id?}', [TagController::class, 'generateTag'])->name('generateTag');

    Route::put('/loan_return/{id}', [LoanController::class, 'return'])->name('loan.return');
    Route::put('/user_password', [UserController::class, 'password'])->name('user.password');
});
