<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
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


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::resource('departments', DepartmentController::class)->except('show');
    Route::resource('employees', EmployeeController::class)->except('show');
    Route::resource('tasks', TaskController::class)->except(['show', 'destroy']);
});
