<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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

        $user->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'profile'=>$profile,
        ]);
        return redirect()->route('products.index');
    }
}
