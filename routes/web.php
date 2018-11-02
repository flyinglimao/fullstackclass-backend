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

// Products

Route::get('/', 'ProductController@index')->name('dashboard.index');

Route::get('products','ProductController@index')->name('products.index');

Route::get('products/edit/{product}','ProductController@edit')->name('products.edit');

Route::post('products/update/{product}','ProductController@update')->name('products.update');

Route::post('products/destroy','ProductController@destroy')->name('products.destroy');

Route::get('products/create','ProductController@create')->name('products.create');

Route::post('products/store','ProductController@store')->name('products.store');

//Admins

Route::get('admins','AdminController@index')->name('admins.index');

Route::get('admins/edit/{admin}','AdminController@edit')->name('admins.edit');

Route::post('admins/update/{admin}','AdminController@update')->name('admins.update');

//Users

Route::get('users','MemberController@index')->name('users.index');

//
