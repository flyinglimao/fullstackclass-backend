<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('id','!=',-1);
        $data = [
            'orders' => $orders->paginate(10),
        ];
        return view('orders.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $data = [
            'order' => $order,
            'pay_date' =>Carbon::createFromFormat('Y-m-d H:i:s.u',
                json_decode($order->payment_information)->time->date)->format('Y-m-d\TH:i:s'),
        ];
//        dd($data);
        return view('orders.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(),[
            'state'=>'required|integer',
            'date'=>'required|date',
            'ship_information'=>'required|string',
            'message'=>'required|string'
        ]);
        $validator->after(function ($validator) use ($order,$request){
            if ($request->input('state')==0 && $order->state==1){
                $validator->errors()->add('state','not allow to change from order to shipping_car');
            }
        })->validate();

        $array = $request->all();
        $json = json_decode($order->payment_information);
        $json->time = Carbon::createFromFormat('Y-m-d\TH:i:s',$array['date']);
        $array['payment_information'] =json_encode($json);

//        dd([$array,$order]);
        $order->update($array);

        return redirect()->route('orders.index');


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
