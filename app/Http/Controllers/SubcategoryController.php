<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $subcategory_id = Subcategory::where('category_id',$category->id)->max('subcategory_id')+1;
        $data = [
            'category' => $category,
            'subcategory_id' =>$subcategory_id
        ];
        return view('subcategories.create',$data);
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
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'name' => 'required|string'
        ]);
        $validator->after(function ($validator)use($request){
            $is_duplicated = Subcategory::where('category_id',$request->input('category_id'))
                ->where('name',$request->input('name'))
                ->get()
                ->count();
            if ($is_duplicated){
                $validator->errors()->add('name','the name is duplicated within the same category');
            }
        })->validate();

        Subcategory::create($request->all());
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
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $data = [
            'subcategory' => $subcategory
        ];
        return view('subcategories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Subcategory $subcategory)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);
        $validator->after(function ($validator) use ($request,$subcategory){
            $is_duplicated = Subcategory::where('category_id',$subcategory->category_id)
                ->where('name',$request->input('name'))
                ->get()
                ->count();
            if ($is_duplicated){
                $validator->errors()->add('name','the name is duplicated within the same category');
            }
        })->validate();

        $subcategory->update($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $has_any_products = $subcategory->products->count();
        if ($has_any_products){
            $msg = '刪除失敗，在刪除此Subcategory前，請先將其所屬的'.$has_any_products.'個商品刪除';
            return redirect()->route('categories.index')
                ->with('alert',$msg);
        }
        $subcategory->delete();
        return redirect()->route('categories.index')->with('success','successfully delete the subcategory');

    }
}
