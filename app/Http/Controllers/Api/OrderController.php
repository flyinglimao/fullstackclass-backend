<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Order;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
  public function index (Request $request) {
    $orders = Order::where('member_id', Auth::id())->paginate(15);
    return OrderResource::collection($orders);
  }

  public function show (Request $request, Order $order) {
    if ($order->member_id !== Auth::id()) {
      return ['success' => false, 'error' => 'no such order'];
    } else {
      OrderResource::withoutWrapping();
      return new OrderResource($order);
    }
  }

  public function cart (Reqeust $requesr) {
    $order = Order::where('member_id', Auth::id())->where('state', 0)->first();
    OrderResource::withoutWrapping();
    return new OrderResource($order);
  }

  public function update (Request $request) {
    $input = $request->only([
      'state', 'pay_method', 'message', 'ship_method', 
      'products', 'receiver', 'receiver_phone', 'coupon',
    ]);

    $order = Order::where('member_id', Auth::id())->where('state', 0)->first();

    if (Input::get('state') == 1) { // Submit Order
      $order += $input;
      dd($order);
    }
    $validator = Validator::make($input, [
      'state' => 'integer|in:1',
      'pay_method' => 'integer',
      'ship_method' => 'integer',
      'products' => 'json',
      'receiver_phone' => 'string|size:10',
    ]);
    if ($order) {
      foreach ($input as $key => $value) {
        $order->$key = $value;
      }
      $order->save();
    } else {
      $input += [
        'state' => 0, 
        'receiver' => Auth::user()->name,
        'products' => '{}',
        'member_id' => Auth::id(),
      ];
      $order = Order::create($input);
    }
    return new OrderResource($order);
  }
}
