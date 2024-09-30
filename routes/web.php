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



// ini route buat auth
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postLogin', 'AuthController@postLogin')->name('postLogin');



// ini buat customer
Route::get('/', [CustomerController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {

//ini buat admin
// Route::get('/homeAdmin', 'AdminController@homeAdmin')->name('homeAdmin');

//ini buat creator
// Route::get('/homeCreator', 'CreatorController@homeCreator')->name('homeCreator');

});


