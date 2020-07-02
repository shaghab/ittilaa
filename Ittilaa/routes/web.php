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
Route::get('/', 'PagesController@Home');

Auth::routes();
Route::get('/home', 'PagesController@Home')->name('home')->middleware('auth');
Route::get('/admin', 'PagesController@Admin')->name('admin')->middleware('auth');
Route::get('/data_entry', 'PagesController@DataForm')->name('data_entry')->middleware('auth');

