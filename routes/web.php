<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
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



// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
// Login
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');


// ini buat customer
Route::get('/', 'CustomerController@homeCustomer')->name('homeCustomer');
Route::get('/detail-event/{id}', [CustomerController::class, 'detailEvent'])->name('detailEvent');
Route::get('/list-events', [CustomerController::class, 'listEvents'])->name('listEvent');
Route::get('/hapusUser',[AdminController::class, 'hapusUser'])->name('hapusUser');


Route::middleware('auth')->group(function () {
    Route::get('/homeAdmin', 'AdminController@homeAdmin')->name('homeAdmin');
    Route::get('/kelolaUser', 'AdminController@kelolaUser')->name('kelolaUser');
    Route::get('/admin/edit-list/{id}', [AdminController::class, 'editList'])->name('admin.editList');
    Route::post('/posteditlist/{id}', [AdminController::class, 'posteditlist'])->name('posteditlist');
    Route::get('/hapusList/{id}', [AdminController::class, 'hapusList'])->name('hapusList');



});

