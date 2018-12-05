<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = Auth::user()->bonuses;
        $orders = Auth::user()->orders;

        $total_orders = 0;

        foreach ($orders as $order){
            $total_orders+=json_decode($order->payment_information)->total;
        }
        $data = [
            'bonuses' => $bonuses,
            'orders' => $orders,
            'total_orders' => $total_orders,
            'receive_from' => Auth::user()->im_receiver
        ];

        return view('home',$data);
    }

    public function edit()
    {
        return view('auth.edit');
    }

    public function update(User $user,Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string',
            'email'=>'required|email',
            'profile'=>'image'
        ]);
        if (isset($request['profile'])){
            $file = $request['profile'];
            $filepath = 'public/user/';
            $filename = 'user'.$user->id.".jpg";
            $profile = 'storage/user/'.$filename;
            $file->storeAs($filepath,$filename);
        }else
            $profile = $user->profile;

//        當電子郵件遭到改變，email_verified_at 會被改成null

        if ($request->input('email')!=$user->email){
            $user->email_verified_at = null;
        }
        $user->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'profile'=>$profile,
        ]);
        return redirect()->route('products.index');
    }
}
