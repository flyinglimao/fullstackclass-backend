<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//product
Route::get('products','Api\ProductController@index');
Route::get('products/{product}','Api\ProductController@show');

//user
Route::middleware('auth:api')->group(function () {
    Route::get('me', 'Api\UserController@showself');
    Route::patch('me', 'Api\UserController@updateself');
});

// bonus
Route::middleware('auth:api')->group(function () {
  Route::get('bonuses', 'Api\BonusController@index');
});

//order
Route::middleware('auth:api')->group(function () {
  Route::get('orders', 'Api\OrderController@index');
  Route::get('orders/cart', 'Api\OrderController@cart');
  Route::get('orders/{order}', 'Api\OrderController@show');
  Route::patch('orders', 'Api\OrderController@update');
  Route::patch('orders/cart', 'Api\OrderController@update');
});

//message
Route::middleware('auth:api')->group(function () {
  Route::get('messages', 'Api\MessageController@index');
  Route::get('messages/{message}', 'Api\MessageController@show');
  Route::delete('messages/{message}', 'Api\MessageController@destroy');
});

//event
Route::get('events', 'Api\EventController@index');

//category
Route::get('categories', 'Api\CategoryController@index');
Route::get('categories/{category}', 'Api\CategoryController@show');

//
//不用保護
Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');
Route::get('login', function () {
  return ['message' => 'post email and password to login'];
})->name('api_login');

//要保護
Route::middleware('auth:api')->group(function (){
  Route::post('logout','Api\AuthController@logout');
  Route::get('refresh','Api\AuthController@refresh');
});

Route::fallback(function () {
    return response()->json(["success" => false, "error" => "denied"], 403);
})->name('api_fall');

