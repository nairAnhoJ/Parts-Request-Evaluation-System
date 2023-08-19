<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluationFormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }else{
        return redirect()->route('login.index');
    }
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login-auth', [LoginController::class, 'login'])->name('login.auth');

Route::get('/change-password', [LoginController::class, 'change'])->name('password.change');
Route::post('/change-password/update', [LoginController::class, 'passwordUpdate'])->name('password.update');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/evaluation-forms', [EvaluationFormController::class, 'index'])->name('form.index');
    Route::get('/evaluation-forms/add', [EvaluationFormController::class, 'add'])->name('form.add');
    Route::post('/evaluation-forms/store', [EvaluationFormController::class, 'store'])->name('form.store');
    Route::get('/evaluation-forms/edit/{key}', [EvaluationFormController::class, 'edit']);
    Route::post('/evaluation-forms/get-customer', [EvaluationFormController::class, 'getCustomer'])->name('form.getCustomer');
    Route::post('/evaluation-forms/get-model', [EvaluationFormController::class, 'getModel'])->name('form.getModel');
    Route::get('/evaluation-forms/delete/{key}', [EvaluationFormController::class, 'delete'])->name('form.delete');

    Route::get('/system-management/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/system-management/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/system-management/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/system-management/users/edit/{key}', [UserController::class, 'edit']);
    Route::post('/system-management/users/update/{key}', [UserController::class, 'update'])->name('users.update');
    Route::get('/system-management/users/delete/{key}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/system-management/users/reset/{key}', [UserController::class, 'reset'])->name('users.reset');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});