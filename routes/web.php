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
Route::get('/registerCustomer', [AuthController::class, 'registerCustomer'])->name('registerCustomer');
Route::post('/postRegisterCustomer', [AuthController::class, 'postRegisterCustomer'])->name('postRegisterCustomer');
Route::get('/registerCreator', [AuthController::class, 'registerCreator'])->name('registerCreator');
Route::post('/postRegisterCreator', [AuthController::class, 'postRegisterCreator'])->name('postRegisterCreator');
// Login
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/loginCreator', [AuthController::class, 'loginCreator'])->name('loginCreator');
Route::post('/postLoginCreator', [AuthController::class, 'postLoginCreator'])->name('postLoginCreator');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ini buat customer
Route::get('/', [CustomerController::class, 'homeCustomer'])->name('homeCustomer');
Route::get('/detail-event/{id}', [CustomerController::class, 'detailEvent'])->name('detailEvent');
Route::get('/list-events', [CustomerController::class, 'listEvents'])->name('listEvent');



//ROUTE ADMIN SAMA KREATOR ITU SIMPENNYA DI DALAM MIDDLEWARE
Route::middleware('auth')->group(function () {


//admin
Route::get('/homeAdmin', 'AdminController@homeAdmin')->name('homeAdmin');
Route::get('/admin/edit-list/{id}', [AdminController::class, 'editList'])->name('admin.editList');
Route::post('/posteditlist/{id}', [AdminController::class, 'posteditlist'])->name('posteditlist');
Route::get('/hapusList/{id}', [AdminController::class, 'hapusList'])->name('hapusList');
Route::get('/kelolaCustomer', 'AdminController@kelolaCustomer')->name('kelolaCustomer');
Route::get('/kelolaKreator', 'AdminController@kelolaKreator')->name('kelolaKreator');
Route::get('/users/pending', [AdminController::class, 'showPendingUsers'])->name('pending.users');
Route::post('/users/approve/{id}', [AdminController::class, 'approveUser'])->name('approve.user');

//ini buat creator
Route::get('/homeCreator', 'CreatorController@homeCreator')->name('homeCreator');
Route::get('/tambahEvent', 'CreatorController@tambahEvent')->name('tambahEvent');
Route::post('/postTambahEvent', 'CreatorController@postTambahEvent')->name('postTambahEvent');
Route::get('/editEvent{event}', 'CreatorController@editEvent')->name('editEvent');
Route::post('/postEditEvent{event}', 'CreatorController@postEditEvent')->name('postEditEvent');
Route::get('/hapusEvent{event}', 'CreatorController@hapusEvent')->name('hapusEvent');

});


