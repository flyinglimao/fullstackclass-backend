<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

    public function index(Request $request)
    {

        $products = Product::where('id','!=',-1);
        // search by category and subcategory
        if ($request->query('category_id'))
        {
            if ($request->query('subcategory_id')){
                $products = $products->where('category_id',$request->query('category_id'))
                                     ->where('subcategory_id',$request->query('subcategory_id'));
            }else{
                $products = $products->where('category_id',$request->query('category_id'));
            }
        }
        else
            $products = $products->orderBy('id','DEC');
        //search by stock
        if ($request->query('stock')){
            $products = $products->where('stock',$request->query('stock'));
        }

        //search by string
        if ($request->query('name')){
            $products = $products->where('title','LIKE','%'.$request->query('name').'%')
                                 ->orWhere('publisher','LIKE','%'.$request->query('name').'%');
        }


        $count = $products->count();
        $products = $products->paginate(5);



        $statement = DB::select("show table status like 'products'");
        $max =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
        $max = json_decode($max)->max_id;

        $categories = Category::all();
        $data = [
            'products' => $products,
            'categories'=>$categories,
            'requests'=>$request,
            'total'=>$count,
            'max_id'=>$max,
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


