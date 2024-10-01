<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for  your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



<<<<<<<<< Temporary merge branch 1
// ini route buat auth

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
=========
>>>>>>>>> Temporary merge branch 2

//ini buat customer
Route::get('/homeCustomer', [CustomerController::class, 'homeCustomer'])->name('homeCustomer');
// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
// Login
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Route::middleware('auth')->group(function () {


// ini buat customer
Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/detailEvent', [CustomerController::class, 'detailEvent'])->name('detailEvent');

Route::middleware('auth')->group(function () {

//ini buat admin
// Route::get('/homeAdmin', 'AdminController@homeAdmin')->name('homeAdmin');

//ini buat creator
// Route::get('/homeCreator', 'CreatorController@homeCreator')->name('homeCreator');

});


