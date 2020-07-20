<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'UsersController@login')->name('login');
Route::get('/register', 'UsersController@register')->name('register');
Route::get('/logout', 'UsersController@logout')->name('logout');

Route::post('/login_user', 'UsersController@loginUser');
Route::post('/register_user', 'UsersController@registerUser');

Route::get('/', 'NotificationsController@index');
// Route::get('/home', 'NotificationsController@index');

Route::get('/admin', 'NotificationsController@pending_index')->name('admin');
Route::get('/admin/pending', 'NotificationsController@pending_index')->name('pending');
Route::get('/admin/approved', 'NotificationsController@approved_index')->name('approved');
Route::get('/admin/rejected', 'NotificationsController@rejected_index')->name('rejected');
Route::get('/data_entry', 'UsersController@dataForm')->name('data_entry');

Route::get('/admin/pending/approve/{notification}', 'NotificationsController@approve')->name('approve_notification');
Route::get('/admin/pending/reject/{notification}', 'NotificationsController@reject')->name('reject_notification');


