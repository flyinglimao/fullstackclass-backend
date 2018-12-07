<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

    public function search()
    {

        $users = User::where('isAdmin',0);
        $data = [
            'users' => $users->paginate(10),
            'total' => $users->count()
        ];
        return view('auth.member',$data);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = Auth::user()->bonuses()->orderBy('created_at','asc')->get();
        $orders = Auth::user()->orders()->where('state',1)->orderBy('created_at','asc')->get();

        $total_orders = 0;

        foreach ($orders as $order){
            if ($order->payment_information != null){
                $total_orders+=json_decode($order->payment_information)->total;
            }
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
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=>'required|email',
            'profile'=>'image'
        ]);
        $validator->after(function ($validator) use ($request){
            $is_duplicated = User::where('email',$request->input('email'))->count();
            if ($is_duplicated){
                $validator->errors()->add('email','這個email已經有人使用了，請換別的');
            }
        })->validate();


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
        return redirect()->route('home');
    }


    public function show(User $user)
    {
        $bonuses = $user->bonuses()->orderBy('created_at','asc')->get();
        $orders = $user->orders()->where('state',1)->orderBy('created_at','asc')->get();

        $total_orders = 0;

        foreach ($orders as $order){
            if ($order->payment_information!=null){
                $total_orders+=json_decode($order->payment_information)->total;
            }

        }
        $data = [
            'user'=>$user,
            'bonuses' => $bonuses,
            'orders' => $orders,
            'total_orders' => $total_orders
        ];
        return view('auth.show',$data);
    }
}
