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

Route::get('/', 'HomeController@index')->name('home');
Route::any('/search', 'HomeController@filter_search')->name('search');

Route::get('/{category}/{region_name?}', 'HomeController@index_cat_region');
Route::get('/{category}/{region_name}/{slug}', 'HomeController@show')->name('show_notification');
Route::get('/tag/{tag}', 'HomeController@searchTag')->name('search_tag'); // TODO: change url to tag='tag_text'

// User login and authorization
Route::get('/login', 'UsersController@login')->name('login');
Route::get('/register', 'UsersController@register')->name('register');
Route::get('/logout', 'UsersController@logout')->name('logout');

Route::post('/login_user', 'UsersController@loginUser')->name('login_user');
Route::post('/register_user', 'UsersController@registerUser')->name('register_user');

// Admin dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/import', 'DashboardController@import')->name('import_csv');
Route::get('/dashboard/data_entry', 'DashboardController@create')->name('data_entry');

Route::get('/dashboard/pending', 'DashboardController@pendingIndex')->name('pending');
Route::get('/dashboard/approved', 'DashboardController@approvedIndex')->name('approved');
Route::get('/dashboard/rejected', 'DashboardController@rejectedIndex')->name('rejected');

Route::post('/dashboard/import:parse', 'NotificationsController@parseFile')->name('parse_csv');
Route::post('/dashboard/import:process', 'NotificationsController@processImport')->name('import_data');
Route::post('/dashboard/data_entry:save', 'NotificationsController@store')->name('save_notificaton');

