<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Subcategory;
use Carbon\Carbon;
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
        $cat_id = $request->input('cat_id');
        $sub_id = $request->input('sub_id');

        if ($sub_id==""){
            $output = '<option value="" selected>'."請選擇".'</option>';
        }else
            $output = '<option value="">'."請選擇".'</option>';


        if ($cat_id !=""){
            $select = $request->input('select');
            $subcategories = Subcategory::where($select,$cat_id)->get();

            foreach ($subcategories as $id=>$subcategory){
                if ($sub_id==$id+1)
                    $output.='<option value="' .$subcategory->subcategory_id. '" selected>' .$subcategory->name. '</option>';
                else
                    $output.='<option value="'.$subcategory->subcategory_id.'" >'.$subcategory->name.'</option>';
            }
        }

        echo $output;
    }

    public function axis(Request $request)
    {
        if ($request->input('type') == 'day'){
            $last_number_hour = 24;
            $start = Carbon::now()->subHour($last_number_hour);
            $x_axis = [];
            foreach (range(1,$last_number_hour/2) as $id) {
                $start = $start->addHour(2);
                array_push($x_axis, $start->format("m-d H"));
            }
        }else if ($request->input('type') == 'week'){
            $last_number_date = 7;
            $start = Carbon::now()->subDay($last_number_date);
            $x_axis = [];
            foreach (range(1,$last_number_date) as $id) {
                $start = $start->addDay(1);
                array_push($x_axis, $start->format("m-d"));
            }
        }
        echo json_encode($x_axis);
    }

    public function dataset(Request $request)
    {
        $array = json_decode($request->input('array'),true);
        $saleValue = [];
        if ($request->input('type')=='week'){
            foreach ($array as $key){
                $sales = Sale::whereDate('created_at','=',Carbon::createFromFormat('m-d',$key))->get();
                $val = 0;
                foreach ($sales as $sale){
                    if ($sale->change < 0){
                        $val -= $sale->change;
                    }
                }
                array_push($saleValue,$val);
            }
        }else if ($request->input('type')=='day'){
            foreach (range(0,11) as $id){
                $start = Carbon::createFromFormat('m-d H',$array[$id]);
                if ($id!=11){
                    $end = Carbon::createFromFormat('m-d H',$array[$id+1]);
                }else {
                    $end = Carbon::createFromFormat('m-d H',$array[$id])->addHour(1);
                }
                $sales = Sale::whereBetween('created_at',[$start,$end])->get();
                $val = 0;
                foreach ($sales as $sale){
                    if ($sale->change < 0){
                        $val -= $sale->change;
                    }
                }
                array_push($saleValue,$val);
            }
        }

        echo json_encode($saleValue);
    }

}
