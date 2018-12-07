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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bonuses = Bonus::where('id','!=',-1);
        if ($request->query('id') != null){
            $bonuses = $bonuses->where('id',$request->query('id'));
        }
        if ($request->query('message')!=null){
            $bonuses = $bonuses->where('message','LIKE','%'.$request->query('message').'%');
        }
        if (is_numeric($request->query('upper'))){
            $bonuses = $bonuses->where('change','<=',$request->query('upper'));
        }
        if (is_numeric($request->query('lower'))){
            $bonuses = $bonuses->where('change','>=',$request->query('lower'));
        }
        if ($request->query('item')!=null){
            $bonuses = $bonuses->orderBy($request->query('item'),$request->query('order'));
        }else{
            $bonuses = $bonuses->orderBy('id','asc');
        }
        $data = [
            'bonuses' =>$bonuses->paginate(10),
            'total' => $bonuses->count()
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
