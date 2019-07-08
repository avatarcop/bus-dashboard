<?php

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

Route::get('/', 'LoginController@login')->name('login');
Route::post('loginn', 'LoginController@authenticate')->name('login');

Auth::routes();

Route::get('home', 'HomeController@dashboard')->name('dashboard');
Route::get('logout', 'HomeController@logout')->name('logout');

// USER
Route::get('user', 'UserController@userlist')->name('user_list');
Route::get('user/create', 'UserController@usercreate')->name('user_create');
Route::get('user/edit/{id}', 'UserController@useredit')->name('user_edit');
Route::post('user/insert', 'UserController@userinsert');
Route::post('user/update', 'UserController@userupdate');
Route::get('user/delete/{id}', 'UserController@userdelete');

