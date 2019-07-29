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
Auth::routes();
Route::get('/discount/product','ProductController@discount')->name('product.discount');
Route::get('/detail/cart','DetailController@cart')->name('detail.cart');
Route::get('/home/user','HomeController@user')->name('home.user')->middleware('auth');
Route::get('/category/{id}','HomeController@category')->name('home.category');
Route::get('/category/{id}/{diskon}','HomeController@diskon')->name('home.diskon');
Route::get('/index/{id}','HomeController@tampil')->name('home.show');
Route::get('/detail/percobaan','DetailController@percobaan')->name('detail.logout');
Route::get('/table/product','ProductController@dataTable')->name('table-product');
Route::get('/history/tampil/{id}/{created}','HistoryController@tampil')->name('history.tampil');
Route::get('/table/history/admin','HistoryController@dataTableAdmin')->name('table-history-admin');
Route::get('/table/history','HistoryController@dataTableUser')->name('table-history');
Route::get('/table/home','HomeController@dataTable')->name('table-user');
Route::get('/table/home/admin','HomeController@dataTableAdmin')->name('table-user-admin');
Route::get('/user/{id}','HomeController@show')->name('user.show');
Route::put('/user/{id}','HomeController@update')->name('user.update');
Route::get('/user/{id}/edit','HomeController@edit')->name('user.edit');
Route::get('/coba','ProductController@test');
Route::get('/diskon','ProductController@diskon')->name('diskon');
Route::get('/history/{id}/print','HistoryController@print')->name('history.print');
Route::get('/pdf/product','ProductController@pdf')->name('pdf-product');
Route::get('/pdf/history','HistoryController@pdf')->name('pdf-history');
Route::put('/diskon/update','ProductController@diskonUpdate')->name('diskon-update');
Route::post('/product/action','ProductController@action')->name('product.action');
Route::post('/history/action','ProductController@action')->name('history.action');
///////////////////////////////////////////////////////////////
Route::resource('/history','HistoryController');
Route::resource('/','HomeController');
Route::resource('/product','ProductController');
Route::resource('/detail','DetailController');
Route::resource('/sell','SellController');