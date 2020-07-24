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

Route::post('/search_region', 'HomeController@searchRegion'); //->name('search_region');
Route::post('/search_department', 'HomeController@searchDepartment');
Route::post('/search_category', 'HomeController@searchCategory');

// Route::get('/search/{department}', 'HomeController@search_by_department')->name('search_department');
// Route::get('/search/{category}', 'HomeController@search_by_category')->name('search_category');

// Route::get('/login', 'UsersController@login')->name('login');
// Route::get('/register', 'UsersController@register')->name('register');
// Route::get('/logout', 'UsersController@logout')->name('logout');

// Route::post('/login_user', 'UsersController@loginUser');
// Route::post('/register_user', 'UsersController@registerUser');


Route::get('/dashboard', 'DashboardController@import')->name('dashboard');
Route::get('/dashboard/import', 'DashboardController@import')->name('import_csv');
// Route::get('/dashboard/pending', 'DashboardController@pending_index')->name('pending');
// Route::get('/dashboard/approved', 'DashboardController@approved_index')->name('approved');
// Route::get('/dashboard/rejected', 'DashboardController@rejected_index')->name('rejected');
// Route::get('/dashboard/data_entry', 'DashboardController@create')->name('data_entry');

