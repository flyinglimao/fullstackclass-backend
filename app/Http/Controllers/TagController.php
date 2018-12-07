<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //取出全部的Tag，不要用all()
        $tags =Tag::where('id','!=',-1);

        //search by name
        if ($request->query('name')!=null){
            $tags = $tags->where('name','LIKE','%'.$request->input('name').'%');
        }


        //search by id

        if ($request->query('id')!=null){
            $tags = $tags->where('id',intval($request->query('id')));
        }

        //order
        if ($request->query('item') != null){
            if ($request->query('order') != null){
                $tags = $tags->orderBy($request->input('item'), $request->input('order'));
            }
        }else $tags = $tags->orderBy('id','asc');



        $total = $tags->count();
        $data = [
            'tags' => $tags->paginate(10),
            'total' => $total
        ];
        return view('tags.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'name' => 'required|string',
        ]);
        $validator->after(function ($validator)use($request){
            $is_duplicated = Tag::where('name',$request->input('name'))->count();
            if ($is_duplicated){
                $validator->errors()->add('name','the tag name is duplicated, plz change the unique one');
            }
        })->validate();
        Tag::create($request->all());
        return redirect()->route('tags.index');
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
    public function edit(Tag $tag)
    {
        $data = [
            'tag' => $tag
        ];
        return view('tags.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
//        dd(123);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);
        $validator->after(function ($validator)use($request,$tag){
            $is_duplicated = Tag::where('id','!==',$tag->id)
                ->where('name',$request->input('name'))
                ->get()
                ->count();
            if ($is_duplicated){
                $validator->errors()->add('name','the tag name is duplicated, plz change the unique one');
            }
        })->validate();
        $tag->update($request->all());
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //still need some validator!!!!
        //!!!!!!!!!!!!
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
