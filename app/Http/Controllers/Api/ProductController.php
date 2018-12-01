<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = new Product;
    if (Input::get('category_id')) {
      $products = $products->where('category_id', Input::get('category_id'));
      if (Input::get('subcategory_id')) {
        $products = $products->where('subcategory_id', Input::get('subcategory_id'));
      }
    }

    if (Input::get('publisher')) {
      $products = $products->where('publisher', Input::get('publisher'));
    }

    if (Input::get('price_range')) {
      $range = explode(',', Input::get('price_range'));
      $products = $products->where('sale_price', '>=', $range[0])->where('sale_price', '<=', $range[1]);
    }

    if (Input::get('available')) {
      $products = $products->where('stock', '>', '0');
    }

    if (Input::get('full')) {
      $data = $products->get();
    } else if (Input::get('count') && is_numeric(Input::get('count'))){
      $data = $products->paginate((int) Input::get('count'));
      $data->links = $data->appends(request()->query())->links();
    } else {
      $data = $products->paginate(30);
    }
    ProductResource::withoutWrapping();
    return ProductResource::collection($data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      "title" => "required|string|max:40",
      "subtitle" => "required|string|max:60",
      "description" => "string|required|max:500",
      "type" => "integer|required|max:1",
      "author" => "string|required|max:30",
      "publisher" => "string|required|max:30",
      "isbn" => "string|required|size:13",
      "category_id" => "integer|required|gt:0",
      "subcategory_id" => "integer|required|gt:0",
      "tags" => "string|required|max:60",
      "list_price" => "integer|required",
      "sale_price" => "integer|required",
      "stock" => "integer|required|gte:0",
    ]); 

    if ($validator->fails()) {
      return $validator->errors();
    } else {
      ProductResource::withoutWrapping();
      return new ProductResource(Product::create($request->all()));
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    //        return response()->json($product,200);
    ProductResource::withoutWrapping();
    return new ProductResource($product);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    foreach ($request->all() as $key => $value) {
      if ($product->$key && $key !== "id") {
        $product->$key = $value;
      }
    }
    $product->save();
    ProductResource::withoutWrapping();
    return new ProductResource($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($product)
  {
    $product = Product::find($product);
    if ($product) {
      if ($product->delete()) {
        return ["success" => true];
      } else {
        return ["success" => false, "error" => "Product cannot be delete"];
      }
    } else {
      return ["success" => false, "error" => "Product not found"];
    }
  }
}
