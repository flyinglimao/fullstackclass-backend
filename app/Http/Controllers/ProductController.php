<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
        if ($request->query('id')!=null){
            $products->where('id',$request->input('id'));
        }
        if ($request->query('tagss')){
            $tagss = $request->input('tagss');
            foreach ($tagss as $tag_id){
                $products = $products->whereHas('tags',function ($q)use($tag_id){
                    $q->where('tag_id',$tag_id);
                });
            }
        }
        //search by order

        if ($request->query('item')){
            $products= $products->orderBy($request->query('item'),$request->query('order'));
        }else
            $products = $products->orderBy('id','asc');

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
        if ($request->query('stock')!=null){
            $products = $products->where('stock',$request->query('stock'));
        }

        //search by string
        if ($request->query('name')!=null){
            $products = $products->where('title','LIKE','%'.$request->query('name').'%')
                                 ->orWhere('publisher','LIKE','%'.$request->query('name').'%')
                                 ->orWhere('author','LIKE','%'.$request->query('name').'%')
                                 ->orWhere('interpreter','LIKE','%'.$request->query('name').'%');
        }
        //search by tags



        $count = $products->count();
        $products = $products->paginate(10);
        //尋找曾出現過最大的id
//        $statement = DB::select("show table status like 'products'");
//        $max =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
//        $max = json_decode($max)->max_id;
        $tags = Tag::all();
        $categories = Category::all();
        $data = [
            'products' => $products,
            'categories'=>$categories,
            'total'=>$count,
            'tags' => $tags,
//            'max_id'=>$max,
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
    $tags = Tag::all();
    $categories = Category::all();
    $data = [
      'categories'=>$categories,
      'tags' => $tags
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

      'list_price'=>'required|integer',
      'sale_price'=>'required|integer',
      'stock'=>'required|integer',
      'picture'=>'image'

    ]);
    //處理圖片
    if(isset($request['picture'])){
        $statement = DB::select("show table status like 'products'");
        $new_id =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
        $new_id = json_decode($new_id)->max_id;
        $file = $request['picture'];
        $filepath = 'public/product/';
        $filename = 'product'.$new_id.'.jpg';
        $file->storeAs($filepath,$filename);
        $url = 'storage/product/'.$filename;
    }
    $array = $request->all();
    $array['picture'] = isset($url)?$url:null;
    //新增商品
    $product = Product::create($array);
    //增加商品tag
    $tags = Tag::orderBy('id','asc')->get();
    foreach ($tags as $tag){
        if ($request->query($tag->id)){
              $product->tags->attach($tag->id);
        }
    }

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
  public function edit($product)
  {
    $tags = Tag::all();
    $categories = Category::all();
    $data = [
      'product'=>$product,
      'categories'=>$categories,
        'tags' => $tags
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
    $validator = Validator::make($request->all(),[
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

        'list_price'=>'required|integer',
        'sale_price'=>'required|integer',
        'stock'=>'required|integer',
        'picture'=>'image',
    ]);
    //處理 check box 的 old value
    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput()
          ->with(['old'=>'old']);
    }
    //處理picture
    $id = $product->id;
    $array = $request->all();
    if(isset($request['picture'])){
        $file = $request['picture'];
        $filepath = 'public/product/';
        $filename = 'product'.$id.'.jpg';
        $file->storeAs($filepath,$filename);
        $array['picture'] = 'storage/product/'.$filename;
    }
    //處理tag
    $tags = Tag::all();
    $attachArray = [];
    foreach ($tags as $tag){
        if ($request->query($tag->id)) {
            $attachArray+=[$tag->id];
        }
    }
    $product->tags()->detach();
    $product->tags()->attach($attachArray);

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


