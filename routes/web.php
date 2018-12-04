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

Route::post('dynamic_dependent/fetch','DynamicSelectController@fetch')->name('dynamicdependent.fetch');

Route::post('dynamic_dependent/prefetch','DynamicSelectController@prefetch')->name('dynamicdependent.prefetch');

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

    //Event CRUD

    Route::get('events','EventController@index')->name('events.index');

    Route::get('events/create','EventController@create')->name('events.create');

    Route::post('events/store','EventController@store')->name('events.store');

    Route::get('events/edit/{event}','EventController@edit')->name('events.edit');

    Route::post('events/update/{event}','EventController@update')->name('events.update');

    Route::delete('events/destroy/{event}','EventController@destroy')->name('events.destroy');

    //Bonus CR

    Route::get('bonuses','BonusController@index')->name('bonuses.index');

    Route::get('bonuses/create','BonusController@create')->name('bonuses.create');

    Route::post('bonuses/store','BonusController@store')->name('bonuses.store');

    //Sale CR

    Route::get('sales','SaleController@index')->name('sales.index');

    Route::get('sales/create','SaleController@create')->name('sales.create');

    Route::post('sales/store','SaleController@store')->name('sales.store');

    //Order CRU

    Route::get('orders','OrderController@index')->name('orders.index');

    Route::get('orders/edit/{order}','OrderController@edit')->name('orders.edit');

    Route::patch('orders/update/{order}','OrderController@update')->name('orders.update');

    //Category

    Route::get('categories','CategoryController@index')->name('categories.index');

    Route::delete('categories/destroy/{category}','CategoryController@destroy')->name('categories.destroy');

    Route::get('categories/create','CategoryController@create')->name('categories.create');

    Route::post('categories/store','CategoryController@store')->name('categories.store');

    Route::get('categories/edit/{category}','CategoryController@edit')->name('categories.edit');

    Route::patch('categories/update/{category}','CategoryController@update')->name('categories.update');

    //Subcategory

    Route::get('categories/subcategories/create/{category}','SubcategoryController@create')->name('subcategories.create');

    Route::post('categories/subcategories/store','SubcategoryController@store')->name('subcategories.store');

    Route::get('categories/subcategories/edit/{subcategory}','SubcategoryController@edit')->name('subcategories.edit');

    Route::patch('categories/subcategories/update/{subcategory}','SubcategoryController@update')->name('subcategories.update');

    Route::delete('subcategories/destroy/{subcategory}','SubcategoryController@destroy')->name('subcategories.destroy');
});

Route::get('products','ProductController@index')->name('products.index');

Route::get('mail/sendmail','MailController@sendmail')->name('sendmail');




Route::get('item/destroy/{id}',function(App\Product $abc){
    dd($abc);
})->name('item.destroy');

Route::get('json/pay_information',function (){
   $a = \App\Order::find(1);
   dd([
       'pay_information'=>json_decode($a->payment_information),
       'products'=>json_decode($a->products)
   ]);
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');





