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



Route::middleware('auth')->group(function (){

    // Products CRUD

    Route::get('products/create','ProductController@create')->name('products.create');

    Route::post('products/store','ProductController@store')->name('products.store');

    Route::get('products/edit/{product}','ProductController@edit')->name('products.edit');

    Route::patch('products/update/{product}','ProductController@update')->name('products.update');

    Route::delete('products/destroy/{product}','ProductController@destroy')->name('products.destroy');


    //User CRUD

    Route::get('user/edit','HomeController@edit')->name('user.edit');

    Route::post('user/update/{user}','HomeController@update')->name('user.update');

    //message CRUD

    Route::get('messages','MessageController@index')->name('messages.index');

    Route::get('messages/create','MessageController@create')->name('messages.create');

    Route::post('messages/store','MessageController@store')->name('messages.store');

    Route::get('messages/edit/{message}','MessageController@edit')->name('messages.edit');

    Route::patch('messages/update/{message}','MessageController@update')->name('messages.update');

    Route::delete('messages/destroy/{message}','MessageController@destroy')->name('messages.destroy');
});

Route::get('products','ProductController@index')->name('products.index');

Route::post('dynamic_dependent/fetch','DynamicSelectController@fetch')->name('dynamicdependent.fetch');

Route::post('dynamic_dependent/prefetch','DynamicSelectController@prefetch')->name('dynamicdependent.prefetch');

Route::get('mail/sendmail','MailController@sendmail')->name('sendmail');

Route::get('item/destroy/{id}',function(App\Product $abc){
    dd($abc);
})->name('item.destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');






//test set


Route::get('a',function (){
    dd(\App\Product::find(2));
});
Route::get('b',function (){
    dd(\App\Product::where('category_id',2));
});
Route::get('c',function (){
    dd(\App\Product::where('category_id',2)->where('subcategory_id',3)->get());
});
Route::get('d',function (){
    dd(\App\Product::where('category_id',2)->first());
});
Route::get('e',function (){
    dd(\App\Category::find(2)->products);
});
