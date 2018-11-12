<?php

use Illuminate\Http\Request;

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
Route::get('products','Api\ProductController@index');

Route::get('products/{product}','Api\ProductController@show');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user', function (Request $request) {
  return response()->json([
    "request" => $request,
    "message" => "Hello world!!",
      "nijaja" => "四代火影"
  ]);
});



//不用保護
Route::get('login','Api\AuthController@login');
Route::get('register','Api\AuthController@register');
//要保護
Route::middleware('auth:api')->group(function (){
    Route::post('orders','Api\OrderController@store');
    Route::post('logout','Api\AuthController@logout');
});

