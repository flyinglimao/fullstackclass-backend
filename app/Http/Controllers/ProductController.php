<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;



class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

    public function index(Request $request)
    {
        if ($request->query('category_id'))
        {
            if ($request->query('subcategory_id')){
                $products = Subcategory::where('category_id',$request->query('category_id'))
                    ->where('subcategory_id',$request->query('subcategory_id'))
                    ->first()
                    ->products;
            }else{
                $products = Category::find($request->query('category_id'))->products;
            }
        }
        else
            $products = Product::inRandomOrder()->get();

        $categories = Category::all();
        $data = [
            'products' => $products,
            'categories'=>$categories,
        ];


        return view('products.index',$data);

    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::all();
    $data = [
      'categories'=>$categories
    ];
    return view('products.create',$data);

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request,[
      'title'=>'required',
      'subtitle'=>'required',
      'description'=>'required',
      'type'=>'required|integer',
      'author'=>'required',
      'publisher'=>'required',
      'isbn'=>'required',
      'category_id'=>'required|integer',
      'subcategory_id'=>'required|integer',
      'tags'=>'required',
      'list_price'=>'required|integer',
      'sale_price'=>'required|integer',
      'stock'=>'required|integer'

    ]);
    Product::create($request->all());

    return redirect()->route('products.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show()
  {

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    $categories = Category::all();
    $data = [
      'product'=>$product,
      'categories'=>$categories
    ];

    return view('products.edit',$data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    $this->validate($request,[
      'title'=>'required',
      'subtitle'=>'required',
      'description'=>'required',
      'type'=>'required|integer',
      'author'=>'required',
      'publisher'=>'required',
      'isbn'=>'required',
      'category_id'=>'required|integer',
      'subcategory_id'=>'required|integer',
      'tags'=>'required',
      'list_price'=>'required|integer',
      'sale_price'=>'required|integer',
      'stock'=>'required|integer'

    ]);
    $product->update($request->all());
    return redirect()->route('products.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */

  public function destroy(Product $product)
  {
    $product->delete();
    return redirect()->route('products.index');
  }
}


