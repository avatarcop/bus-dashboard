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

Route::get('/lolo', 'LoginController@login')->name('login');
Route::post('loginn', 'LoginController@authenticate');

Auth::routes();

Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('logout', 'HomeController@logout');

// USER
Route::get('user', 'UserController@userlist')->name('user.list');
Route::get('user/create', 'UserController@usercreate')->name('user.create');
Route::get('user/edit/{id}', 'UserController@useredit')->name('user.edit');
Route::post('user/insert', 'UserController@userinsert');
Route::post('user/update', 'UserController@userupdate');
Route::get('user/delete/{id}', 'UserController@userdelete')->name('user.delete');

// ACCESSCONTROL
Route::get('accesscontrol', 'AccessController@accesscontrollist')->name('accesscontrol.list');
Route::get('accesscontrol/create', 'AccessController@accesscontrolcreate')->name('accesscontrol.create');
Route::get('accesscontrol/edit/{id}', 'AccessController@accesscontroledit')->name('accesscontrol.edit');
Route::post('accesscontrol/insert', 'AccessController@accesscontrolinsert');
Route::post('accesscontrol/update', 'AccessController@accesscontrolupdate');
Route::get('accesscontrol/delete/{id}', 'AccessController@accesscontroldelete')->name('accesscontrol.delete');

// MASTER PO
Route::get('po', 'PoController@polist')->name('po.list');
Route::get('po/create', 'PoController@pocreate')->name('po.create');
Route::get('po/edit/{id}', 'PoController@poedit')->name('po.edit');
Route::post('po/insert', 'PoController@poinsert');
Route::post('po/update', 'PoController@poupdate');
Route::get('po/delete/{id}', 'PoController@podelete')->name('po.delete');

// MASTER BUS
Route::get('bus', 'BusController@buslist')->name('bus.list');
Route::get('bus/create', 'BusController@buscreate')->name('bus.create');
Route::get('bus/edit/{id}', 'BusController@busedit')->name('bus.edit');
Route::post('bus/insert', 'BusController@businsert');
Route::post('bus/update', 'BusController@busupdate');
Route::get('bus/delete/{id}', 'BusController@busdelete')->name('bus.delete');

// MASTER TIPEKURSI
Route::get('tipekursi', 'TipekursiController@tipekursilist')->name('tipekursi.list');
Route::get('tipekursi/create', 'TipekursiController@tipekursicreate')->name('tipekursi.create');
Route::get('tipekursi/edit/{id}', 'TipekursiController@tipekursiedit')->name('tipekursi.edit');
Route::post('tipekursi/insert', 'TipekursiController@tipekursiinsert');
Route::post('tipekursi/update', 'TipekursiController@tipekursiupdate');
Route::get('tipekursi/delete/{id}', 'TipekursiController@tipekursidelete')->name('tipekursi.delete');

// MASTER CUSTOMER
Route::get('customer', 'CustomerController@customerlist')->name('customer.list');
Route::get('customer/create', 'CustomerController@customercreate')->name('customer.create');
Route::get('customer/edit/{id}', 'CustomerController@customeredit')->name('customer.edit');
Route::post('customer/insert', 'CustomerController@customerinsert');
Route::post('customer/update', 'CustomerController@customerupdate');
Route::get('customer/delete/{id}', 'CustomerController@customerdelete')->name('customer.delete');

// MASTER TRANSAKSI
Route::get('transaksi', 'TransaksiController@transaksilist')->name('transaksi.list');
Route::get('transaksi/create', 'TransaksiController@transaksicreate')->name('transaksi.create');
Route::get('transaksi/edit/{id}', 'TransaksiController@transaksiedit')->name('transaksi.edit');
Route::post('transaksi/insert', 'TransaksiController@transaksiinsert');
Route::post('transaksi/update', 'TransaksiController@transaksiupdate');
Route::get('transaksi/delete/{id}', 'TransaksiController@transaksidelete')->name('transaksi.delete');
Route::get('transaksi/bayar/{id}', 'TransaksiController@transaksibayar')->name('transaksi.bayar');

Route::get('transaksi_notif', 'TransaksiController@transaksinotif')->name('transaksi.notifikasi');

