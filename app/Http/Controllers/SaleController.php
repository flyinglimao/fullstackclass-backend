<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Sale;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = Sale::where('id','!=',-1);
        if ($request->query('products_id')!=null){
            $sales = $sales->where('products_id',$request->query('products_id'));
        }
        if ($request->query('product_name')!=null){
            echo 'product_name'.$sales->count();
            $sales = $sales->whereHas('product',function ($q)use($request){
                $q->where('title','LIKE','%'.$request->query('product_name').'%');
            });
            echo 'product_name'.$sales->count();
        }

        if ($request->query('id')!=null){
            $sales = $sales->where('id',$request->query('id'));
        }
        if ($request->query('invoice_number')!=null){
            $sales = $sales->whereHas('order',function ($q)use($request){
                $q->where('invoice_number','like','%'.$request->query('invoice_number').'%');
            });
        }
        if ($request->query('item')!=null){
            $sales = $sales->orderBy($request->query('item'),$request->query('order'));
        }else{
            $sales = $sales->orderBy('id','asc');
        }
        if ($request->query('tagss')){
            $tagss = $request->input('tagss');

            $sales = $sales->whereHas('product',function ($q)use($tagss){
                foreach ($tagss as $tag_id){
                    $q->whereHas('tags',function ($d)use($tag_id){
                        $d->where('tag_id',$tag_id);
                    });
                }
            });

        }




        $date = [
            'sales' => $sales->paginate(10),
            'tags' => Tag::all(),
            'total' =>$sales->count(),
        ];
        return view('sales.index',$date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'change' => 'required|integer',
            'message' => 'required|string',
            'products_id' => 'required|integer',
            'order_id' => 'nullable|integer',
        ]);
        $validator->after(function ($validator) use ($request){
            $product_exist = Product::where('id',$request['products_id'])->first();
            if ($product_exist == null){
                $validator->errors()->add('product_id','product id does not exist!!');
            }
            if ($request->query('order_id')){
                $order_exist = Order::where('id',$request['order_id'])->first();
                if ($order_exist == null){
                    $validator->errors()->add('order_id','order id does not exist!!');
                }
            }

            //不知道要不要加 確認product->stock的數量是否會少於0 的validation



        })->validate();
        $sale = Sale::create($request->all());
        $product = $sale->product;
        $product->stock +=$sale->change;
        $product->save();

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
