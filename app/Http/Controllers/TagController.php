<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('updated_at','dec')->paginate(10);
        $data = [
            'tags' => $tags
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
