<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\PaymentController;
use Database\Seeders\CreatorSeeder;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;

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
Route::get('password/reset', function () {
     return view('password.email');
 })->name('password.request');
 Route::get('password/reset/{token}', [AuthController::class, 'ResetForm'])->name('password.reset');
 Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
 Route::post('password/reset', [AuthController::class, 'postReset'])->name('password.update');



// ini buat customer
Route::get('/', [CustomerController::class, 'homeCustomer'])->name('homeCustomer');
Route::get('/detail-event/{id}', [CustomerController::class, 'detailEvent'])->name('detailEvent');
Route::get('/list-events', [CustomerController::class, 'listEvents'])->name('listEvent');
Route::get('/search', [CustomerController::class, 'search'])->name('search');






//ROUTE ADMIN SAMA KREATOR ITU SIMPENNYA DI DALAM MIDDLEWARE
Route::middleware('auth')->group(function () {

//MIDTRANS
Route::get('/transaksi{detail}', [PaymentController::class, 'createTransaction'])->name('transaksi.detail');
Route::post('/transaksi/create', [PaymentController::class, 'createTransaction'])->name('transaksi.create');
Route::post('/midtrans-notification', [PaymentController::class, 'handleNotification']);

Route::get('/transaksi/{kode_tiket}', [PaymentController::class, 'show'])->name('transaksi.show');
Route::get('/download/tiket/{id}', [PaymentController::class, 'downloadTiket'])->name('downloadTiket');
Route::get('/midtrans/callback', [PaymentController::class, 'midtransCallback'])->name('midtransCallback');
Route::delete('/transaksi/{id}', [PaymentController::class, 'destroy'])->name('destroyTransaksi');





Route::get('/history', [CustomerController::class, 'history'])->name('history');
Route::get('/transaksi/{id}', [CustomerController::class, 'transaksi'])->name('transaksi');
Route::get('/transaksi/{tiket}/{id}', [CustomerController::class, 'transaksi'])->name('transaksi.tiket');
Route::get('/transaksi/{event}', [CustomerController::class, 'transaksi'])->name('transaksi.event');



// //EMAIL
// Route::get('/konfirmasi', [emailController::class, 'konfirmasi'])->name('konfirmasi');
// Route::post('/midtrans/callback', [emailController::class, 'callbackMidtrans'])->name('callbackMidtrans');
Route::get('/transaksi/konfirmasi', [emailController::class, 'showConfirmation'])->middleware('auth')->name('transaksi.konfirmasi');

//admin
Route::get('/homeAdmin', 'AdminController@homeAdmin')->name('homeAdmin');
Route::get('/listEventAdm', [AdminController::class, 'listEventAdm'])->name('listEventAdm');
Route::get('/edit-list/{id}', [AdminController::class, 'editList'])->name('admin.editList');
Route::post('/posteditlist/{id}', [AdminController::class, 'posteditlist'])->name('posteditlist');
Route::get('/hapusList/{event}', [AdminController::class, 'hapusList'])->name('hapusList');
Route::get('/hapusCustomer/{user}', [AdminController::class, 'hapusCustomer'])->name('hapusCustomer');
Route::get('/hapusKreator/{user}', [AdminController::class, 'hapusKreator'])->name('hapusKreator');
Route::get('/kelolaCustomer', 'AdminController@kelolaCustomer')->name('kelolaCustomer');
Route::get('/kelolaKreator', 'AdminController@kelolaKreator')->name('kelolaKreator');
Route::get('/users/pending', [AdminController::class, 'showPendingUsers'])->name('pending.users');
Route::post('/users/approve/{id}', [AdminController::class, 'approveUser'])->name('approve.user');
Route::get('/profileAdmin', [AdminController::class, 'profileAdmin'])->name('profileAdmin');
Route::get('/editProfileAdmin{id}',[AdminController::class,'editProfileAdmin'])->name('editProfileAdmin');
Route::post('postEditProfileAdmin{id}',[AdminController::class,'postEditProfileAdmin'])->name('postEditProfileAdmin');
Route::get('/ChangePassMin',[AdminController::class, 'ChangePassMin'])->name('ChangePassMin');
Route::post('/postChangePassMin', [AdminController::class, 'postChangePassMin'])->middleware('auth')->name('postChangePassMin');
Route::delete('/reject-user/{id}', [AdminController::class, 'rejectUser'])->name('rejectUser');




//ini buat creator
Route::get('/homeCreator', [CreatorController::class, 'homeCreator'])
     ->middleware('auth', 'check.approval')
     ->name('homeCreator');

Route::get('/kelolaEvent', 'CreatorController@kelolaEvent')->name('kelolaEvent');
Route::get('/tambahEvent', 'CreatorController@tambahEvent')->name('tambahEvent');
Route::post('/postTambahEvent', 'CreatorController@postTambahEvent')->name('postTambahEvent');
Route::get('/editEvent{id}', 'CreatorController@editEvent')->name('editEvent');
Route::post('/postEditEvent{id}', 'CreatorController@postEditEvent')->name('postEditEvent');
Route::get('/hapusEvent{event}', 'CreatorController@hapusEvent')->name('hapusEvent');
Route::get('/kelolaTiket', 'CreatorController@kelolaTiket')->name('kelolaTiket');
Route::get('/editTiket{id}', 'CreatorController@editTiket')->name('editTiket');
Route::post('/postEditTiket{id}', 'CreatorController@postEditTiket')->name('postEditTiket');
Route::delete('/hapusTiket{id}', 'CreatorController@hapusTiket')->name('hapusTiket');
Route::get('/profil', [CustomerController::class, 'profil'])->name('profil');
Route::get('/editProfileCust/{id}',[CustomerController::class,'editProfileCust'])->name('editProfileCust');
Route::post('postEditProfileCust{id}',[CustomerController::class,'postEditProfileCust'])->name('postEditProfileCust');
Route::get('/ChangePass',[CustomerController::class, 'ChangePass'])->name('ChangePass');
Route::post('/change-password', [CustomerController::class, 'postChangePass'])->middleware('auth')->name('postChangePass');;
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/tambahtiket/{event_id}', 'CreatorController@tambahtiket')->name('tambahtiket');
Route::post('/tambahtiket', [CreatorController::class, 'storeTicket'])->name('tambahtiket.store');
// Route::get('/scanQr', [CreatorController::class, 'scanQr'])->name('scanQr');
// Route::post('/postScanQr', [CreatorController::class, 'postScanQr'])->name('postScanQr');
// Route::get('/getPurchaserDetails', [CreatorController::class, 'getPurchaserDetails'])->name('getPurchaserDetails');

// Route::get('/editTiket/{id}', [CreatorController::class, 'editTiket'])->name('editTiket');
// Route::post('/postEditTiket/{id}', [CreatorController::class, 'postEditTiket'])->name('postEditTiket');

Route::get('/profilCreator', [CreatorController::class, 'profilCreator'])->name('profilCreator');
Route::get('/editProfileCreator/{id}',[CreatorController::class,'editProfileCreator'])->name('editProfileCreator');
Route::post('postEditProfileCreator{id}',[CreatorController::class,'postEditProfileCreator'])->name('postEditProfileCreator');
Route::get('/ubahpass',[CreatorController::class, 'ubahpass'])->name('ubahpass');
Route::post('/postubahpass', [CreatorController::class, 'postubahpass'])->middleware('auth')->name('postubahpass');;
Route::get('/grafik{user_id}', [CreatorController::class, 'grafik'])->name('grafik');
Route::get('/sendTickets', [CreatorController::class, 'sendTickets'])->name('sendTickets');
Route::get('/scan-qr', [CreatorController::class, 'ScanQr'])->name('scanQr');
Route::post('/scan-qr', [CreatorController::class, 'postScanQr'])->name('postScanQr');

});


