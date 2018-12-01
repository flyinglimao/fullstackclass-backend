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
Route::middleware('auth:api', 'admin')->group(function () {
    Route::post('products','Api\ProductController@create');
    Route::patch('products/{product}','Api\ProductController@update');
    Route::delete('products/{product}','Api\ProductController@destroy');
});

//user
Route::middleware('auth:api')->group(function () {
    Route::get('me', 'Api\UserController@showself');
    Route::patch('me', 'Api\UserController@updateself');
    Route::middleware('admin')->group(function () {
      Route::get('users', 'Api\UserController@index');
      Route::get('users/{user}', 'Api\UserController@show');
      Route::post('users', 'Api\UserController@create');
      Route::patch('users/{user}', 'Api\UserController@update');
      Route::delete('users/{user}', 'Api\UserController@destroy');
    });
});

// bonus
Route::middleware('auth:api')->group(function () {
  Route::get('bonuses', 'Api\BonusController@index');
});

//order
Route::middleware('auth:api')->group(function () {
  Route::get('orders', 'Api\OrderController@index');
  Route::get('orders/{order}', 'Api\OrderController@show');
  Route::patch('orders', 'Api\OrderController@update');
});

//message
Route::middleware('auth:api')->group(function () {
  Route::get('messages', 'Api\MessageController@show');
  Route::delete('messages/{message}', 'Api\MessageController@destroy');
});

//event
Route::get('events', 'Api\EventController@index');

//
//不用保護
Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');

//要保護
Route::middleware('auth:api')->group(function (){
  Route::post('logout','Api\AuthController@logout');
  Route::get('refresh','Api\AuthController@refresh');
});

Route::fallback(function () {
    return response()->json(["success" => false, "error" => "denied"], 403);
});

