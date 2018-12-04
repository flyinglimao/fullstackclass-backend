<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Bonus;
use App\User;
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

  public function cart (Request $requesr) {
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

    if ($order == null) {
      $input += [
        'state' => 0, 
        'receiver' => Auth::user()->name,
        'products' => '{}',
        'member_id' => Auth::id(),
      ];
      $order = Order::create($input);
    }
    if (Input::get('state') == 1) { // Submit Order
      foreach ($input as $key => $value) {
        $order->$key = $value;
      }
      if ($order->message == null) {
        $order->message = '';
      }
      $validator = Validator::make($order->toArray(), [
        'pay_method' => 'required|integer|in:0',
        'ship_method' => 'required|integer|in:0,1,2',
        'receiver_phone' => 'required|string|size:10',
        'receiver' => 'required|string',
        'message' => 'string|max:255'
      ]);
      $products = json_decode(Input::get('products'));
      $total = 0;
      foreach ($products as $product => $count) {
        if ($item = Product::find($product)) {
          $total += $item->sale_price * $count;
        } else {
          unset($products->$product);
        }
      }
      if ($validator->fails()) {
        $order->state = 0;
        $order->save();
        return (new OrderResource($order))->additional(['success' => false, 'error' => $validator->errors()]);
      } else if (count((array)$products) === 0) {
        $order->state = 0;
        $order->save();
        return (new OrderResource($order))->additional(['success' => false, 'error' => 'order is empty']);
      } else {
        $order->products = json_encode($products);
        $order->payment_information = json_encode(['total' => $total]);
        $bonus = floor($total * 0.01);
        if ($bonus > 0) {
          Bonus::create([
            'change' => $bonus,
            'message' => '購物贈送',
            'order_id' => $order->id,
            'user_id' => Auth::id(),
          ]);
          $user = Auth::user();
          $user->bonus += $bonus;
          $user->save();
        }
        $order->save();
        return (new OrderResource($order))->additional(['success' => true, 'bonus' => $bonus]);
      }
    } else { // Just Update
      foreach ($input as $key => $value) {
        $order->$key = $value;
      }
      $products = json_decode(Input::get('products'));
      foreach ($products as $product => $count) {
        if ($item = Product::find($product)) {
        } else {
          unset($products->$product);
        }
      }
      $order->products = json_encode($products);
      $order->save();
    }

    return new OrderResource($order);
    //*/
  }
}
