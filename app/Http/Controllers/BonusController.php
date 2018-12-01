<?php

namespace App\Http\Controllers;

use App\Bonus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'bonuses' =>Bonus::paginate(10),
        ];
        return view('bonuses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bonuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bonus $bonus
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|integer',
            'change'=>'required|integer',
            'message'=>'required|string',
        ]);
        $validator->after(function ($validator) use ($request){
            $id = $request->input('user_id');
            $user_exist = User::where('id',$id)->first();
            if ($user_exist==null){
                $validator->errors()->add('user_id','user_id does not exist');
            }
        })->validate();



        $bonus = Bonus::create($request->all());
        $user = $bonus->user;
        $user->bonus+=$bonus->change;
        $user->save();
        return redirect()->route('bonuses.index');
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
     * @param  Bonus $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
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
