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

// Auth::routes();
Route::get('/login', 'PagesController@Login');
Route::get('/admin', 'PagesController@Admin');
Route::get('/data_entry', 'PagesController@DataForm');
Route::get('/notification', 'PagesController@Notification');
Route::get('/notification2', 'PagesController@Notification2');

