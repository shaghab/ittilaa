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

Route::get('/', 'UsersController@index');
Route::get('/home', 'UsersController@index');
Route::get('/login', 'UsersController@login');
Route::get('/register', 'UsersController@register');
Route::get('/logout', 'UsersController@logout');

Route::post('/login_user', 'UsersController@loginUser');
Route::post('/register_user', 'UsersController@registerUser');

Route::get('/admin', 'UsersController@admin');
Route::get('/data_entry', 'UsersController@dataForm');

