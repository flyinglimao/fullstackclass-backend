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



Route::get('/', 'ProductController@index')->name('dashboard.index');

// Products

Route::get('products','ProductController@index')->name('products.index');

Route::get('products/create','ProductController@create')->name('products.create');

Route::post('products/store','ProductController@store')->name('products.store');

Route::get('products/edit/{product}','ProductController@edit')->name('products.edit');

Route::patch('products/update/{product}','ProductController@update')->name('products.update');

Route::delete('products/destroy/{product}','ProductController@destroy')->name('products.destroy');



//Admins

Route::get('admins','AdminController@index')->name('admins.index');

Route::get('admins/create','AdminController@create')->name('admins.create');

Route::post('admins/store','AdminController@store')->name('admins.store');

Route::get('admins/edit/{admin}','AdminController@edit')->name('admins.edit');

Route::patch('admins/update/{admin}','AdminController@update')->name('admins.update');

Route::delete('admins/destroy/{admin}','AdminController@destroy')->name('admins.destroy');



//Users

Route::get('users','UserController@index')->name('users.index');

//
