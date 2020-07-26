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

Route::get('/', 'HomeController@index');
Route::get('/notification/{notification}', 'NotificationsController@show')->name('show_notification');

Route::post('/search/region', 'HomeController@searchRegion')->name('search_region');
Route::post('/search/department', 'HomeController@searchDepartment')->name('search_department');
Route::post('/search/category', 'HomeController@searchCategory')->name('search_category');

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

Route::post('/dashboard/import/parse', 'NotificationsController@parseFile')->name('parse_csv');
Route::post('/dashboard/import/process', 'NotificationsController@processImport')->name('import_data');
Route::post('/dashboard/data_entry/save', 'NotificationsController@store')->name('save_notificaton');

