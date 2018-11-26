<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;

class DynamicSelectController extends Controller
{

    public function fetch(Request $request)
    {

        $value = $request->input('value');
        $output = '<option value="">'."請選擇".'</option>';
        if ($value !=""){
            $select = $request->input('select');
            $subcategories = Subcategory::where($select,$value)->get();

            foreach ($subcategories as $id=>$subcategory){
                $output.='<option value="'.$subcategory->subcategory_id.'" >'.$subcategory->name.'</option>';
            }
        }


        echo $output;
    }
    public function prefetch(Request $request)
    {

        $value = $request->input('value');
        $output = "";
        $sub_id = $request->input('sub_id');
        if ($value !=""){
            $select = $request->input('select');
            $subcategories = Subcategory::where($select,$value)->get();

            foreach ($subcategories as $id=>$subcategory){
                if ($sub_id==$id+1)
                    $output.='<option value="' .$subcategory->subcategory_id. '" selected>' .$subcategory->name. '</option>';
                else
                    $output.='<option value="'.$subcategory->subcategory_id.'" >'.$subcategory->name.'</option>';
            }
        }
        echo $output;
    }

}