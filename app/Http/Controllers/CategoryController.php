<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::paginate(10),
        ];
        return view('categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|string'
        ]);
        $validator->after(function ($validator)use($request){
            if (Category::where('name',$request->input('name'))->get() == null){
                $validator->errors()->add('name','the category name is duplicated, please choose the unique one.');
            }
        })->validate();
        Category::create($request->all());
        return redirect()->route('categories.index');
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
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data = [
            'category' => $category,
        ];
        return view('categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required|string',
        ]);
        $validator->after(function ($validator)use($request){
            $is_duplicated = Category::where('id','!=',$request->input('id'))
                ->where('name',$request->input('name'))
                ->get()
                ->count();
            if ($is_duplicated){
                $validator->errors()->add('name','the name is duplicated, please choose unique one.');
            }
        })->validate();
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->subcategories->count() == 0){
            $category->delete();
        }else{
            return redirect()->route('categories.index')->with('alert', 'there are some subcategory within the category plz delete then all!!!');
        }
        return redirect()->route('categories.index')->with('success','successful delete the category');
    }
}
