<?php

namespace App\Http\Controllers;

use App\Sale;
use Carbon\Carbon;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $x_axis = $this->axis();
        $data = [
            'x_axis' => $x_axis,
            'dataset' => $this->dataset($x_axis),
        ];
        return view('statistics.index',$data);
    }

    public function axis()
    {

        $last_number_date = 7;
        $start = Carbon::now()->subDay($last_number_date);
        $x_axis = [];
        foreach (range(1,$last_number_date) as $id) {
            $start = $start->addDay(1);
            array_push($x_axis, $start->format("m-d"));
        }


        return json_encode($x_axis);
    }

    public function dataset($array)
    {
        $array = json_decode($array,true);
        $saleValue = [];
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
        return json_encode($saleValue);
    }
}
