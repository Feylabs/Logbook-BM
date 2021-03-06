<?php

use Illuminate\Support\Facades\Route;

include __DIR__.'/adminmart.php';
include __DIR__.'/user_admin.php';
include __DIR__.'/user_santri.php';
include __DIR__.'/user_guru.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::redirect('/','/login')->middleware('myAuth');

Route::view('login/santri','auth.login_santri')->middleware('myAuth');

Route::view('register/new_account','auth.register_santri')->middleware('myAuth');

Route::view('/login','auth.login_santri')->middleware('myAuth');
Route::view('login/admin','auth.login_admin')->middleware('myAuth');

Route::post('/login/santri/proc', 'Auth\LoginController@santriLogin')->name('login-santri');
Route::post('/login/admin/proc', 'Auth\LoginController@adminLogin')->name('login-admin');

Route::post('/santri/storeSelf', 'SantriController@storeSelf');

Route::any('santri/{id}/resetPassword','SantriController@resetPassword');
Route::any('guru/{id}/resetPassword','GuruController@resetPassword');



//These 3 Route Not Used Yet
// Route::post('/logout-santri', 'Auth\LoginController@logoutStudent')->name('logout-santri');
// Route::post('/logout-guru', 'Auth\LoginController@logoutMentor')->name('logout-guru');
// Route::post('/logout-admin', 'Auth\LoginController@logoutMentor')->name('logout-admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
