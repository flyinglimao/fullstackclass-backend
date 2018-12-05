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

        if ($request->query('item')){
            if ($request->query('order')){
                $products= Product::orderBy($request->query('item'),$request->query('order'));
            }else
                $products= Product::orderBy($request->query('item'),'desc');
        }else
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
        $products = $products->paginate(10);
        //尋找曾出現過最大的id
        $statement = DB::select("show table status like 'products'");
        $max =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
        $max = json_decode($max)->max_id;

        $categories = Category::all();
        $data = [
            'products' => $products,
            'categories'=>$categories,
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
      'author'=>'required|string',
      'author_description'=>'string',
      'interpreter'=>'string',
      'publisher'=>'required',
      'publish_year'=>'required|integer|min:0',
      'isbn'=>'required',
      'category_id'=>'required|integer',
      'subcategory_id'=>'required|integer',
      'tags'=>'required',
      'list_price'=>'required|integer',
      'sale_price'=>'required|integer',
      'stock'=>'required|integer',
      'picture'=>'image'

    ]);
      $statement = DB::select("show table status like 'products'");
      $new_id =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
      $new_id = json_decode($new_id)->max_id;

    if(isset($request['picture'])){
        $file = $request['picture'];
        $filepath = 'public/product/';
        $filename = 'product'.$new_id.'.jpg';
        $file->storeAs($filepath,$filename);
        $url = 'storage/product/'.$filename;
    }
    $array = $request->all();
    $array['picture'] = isset($url)?$url:null;
    Product::create($array);

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
      'author_description'=>'string',
      'interpreter'=>'string',
      'publisher'=>'required',
      'publish_year'=>'required|integer|min:0',
      'isbn'=>'required',
      'category_id'=>'required|integer',
      'subcategory_id'=>'required|integer',
      'tags'=>'required',
      'list_price'=>'required|integer',
      'sale_price'=>'required|integer',
      'stock'=>'required|integer',
      'picture'=>'image',

    ]);
    $id = $product->id;
    $array = $request->all();
    if(isset($request['picture'])){
        $file = $request['picture'];
        $filepath = 'public/product/';
        $filename = 'product'.$id.'.jpg';
        $file->storeAs($filepath,$filename);
        $array['picture'] = 'storage/product/'.$filename;
    }


    $product->update($array);
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


