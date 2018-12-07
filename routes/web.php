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






Route::post('dynamic_dependent/fetch','DynamicSelectController@fetch')->name('dynamicdependent.fetch');

Route::post('dynamic_dependent/prefetch','DynamicSelectController@prefetch')->name('dynamicdependent.prefetch');

Route::get('item/destroy/{id}',function(){})->name('item.destroy');

Route::middleware('auth','is_admin')->group(function (){

    Route::middleware('verified')->group(function (){

        Route::get('/', 'ProductController@index')->name('dashboard.index');

        // Products CUD

        Route::post('products/store','ProductController@store')->name('products.store');

        Route::get('products/edit/{product}','ProductController@edit')->name('products.edit');

        Route::patch('products/update/{product}','ProductController@update')->name('products.update');

        Route::delete('products/destroy/{product}','ProductController@destroy')->name('products.destroy');

        Route::get('products/create','ProductController@create')->name('products.create');

        //Messages CUD

        Route::get('messages/create','MessageController@create')->name('messages.create');

        Route::post('messages/store','MessageController@store')->name('messages.store');

        Route::get('messages/edit/{message}','MessageController@edit')->name('messages.edit');

        Route::patch('messages/update/{message}','MessageController@update')->name('messages.update');

        Route::delete('messages/destroy/{message}','MessageController@destroy')->name('messages.destroy');

        //Event CUD

        Route::get('events/create','EventController@create')->name('events.create');

        Route::post('events/store','EventController@store')->name('events.store');

        Route::get('events/edit/{event}','EventController@edit')->name('events.edit');

        Route::post('events/update/{event}','EventController@update')->name('events.update');

        Route::delete('events/destroy/{event}','EventController@destroy')->name('events.destroy');

        //Bonus C

        Route::get('bonuses/create','BonusController@create')->name('bonuses.create');

        Route::post('bonuses/store','BonusController@store')->name('bonuses.store');

        //Sales C

        Route::get('sales/create','SaleController@create')->name('sales.create');

        Route::post('sales/store','SaleController@store')->name('sales.store');

        //Order C

        Route::get('orders/edit/{order}','OrderController@edit')->name('orders.edit');

        Route::patch('orders/update/{order}','OrderController@update')->name('orders.update');

        //Categories CUD

        Route::get('categories/create','CategoryController@create')->name('categories.create');

        Route::post('categories/store','CategoryController@store')->name('categories.store');

        Route::get('categories/edit/{category}','CategoryController@edit')->name('categories.edit');

        Route::patch('categories/update/{category}','CategoryController@update')->name('categories.update');

        Route::delete('categories/destroy/{category}','CategoryController@destroy')->name('categories.destroy');

        //Subcategory CUD

        Route::get('categories/subcategories/create/{category}','SubcategoryController@create')->name('subcategories.create');

        Route::post('categories/subcategories/store','SubcategoryController@store')->name('subcategories.store');

        Route::get('categories/subcategories/edit/{subcategory}','SubcategoryController@edit')->name('subcategories.edit');

        Route::patch('categories/subcategories/update/{subcategory}','SubcategoryController@update')->name('subcategories.update');

        Route::delete('subcategories/destroy/{subcategory}','SubcategoryController@destroy')->name('subcategories.destroy');

        //Tag CUD

        Route::get('tags/create','TagController@create')->name('tags.create');

        Route::get('tags/edit/{tag}','TagController@edit')->name('tags.edit');

        Route::post('tags/store','TagController@store')->name('tags.store');

        Route::patch('tags/update/{tag}','TagController@update')->name('tags.update');

        Route::delete('tags/destroy/{tag}','TagController@destroy')->name('tags.destroy');

        //
    });
    //MemberSerach

    Route::get('user/index','HomeController@search')->name('user.search');

    Route::get('user/show/{user}','HomeController@show')->name('user.show');

    //User RU

    Route::get('user/edit','HomeController@edit')->name('user.edit');

    Route::post('user/update/{user}','HomeController@update')->name('user.update');

    //Product R

    Route::get('products','ProductController@index')->name('products.index');

    //message R

    Route::get('messages','MessageController@index')->name('messages.index');

    //Event R

    Route::get('events','EventController@index')->name('events.index');

    //Bonus R

    Route::get('bonuses','BonusController@index')->name('bonuses.index');

    //Sale R

    Route::get('sales','SaleController@index')->name('sales.index');

    //Order R

    Route::get('orders','OrderController@index')->name('orders.index');

    //Category R

    Route::get('categories','CategoryController@index')->name('categories.index');

    //Tag R

    Route::get('tags','TagController@index')->name('tags.index');

    //Test mail

    Route::get('mail','MailController@index')->name('mails.index');

    Route::get('mail/notify/order2','MailController@index2')->name('mails.index2');

    Route::get('mail/notify/order3','MailController@index3')->name('mails.index3');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Auth::routes(['verify' => true]);







