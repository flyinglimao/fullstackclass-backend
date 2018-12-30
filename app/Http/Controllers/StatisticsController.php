<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {

        $data = [
            'x_axis' => $this->x_axis()
        ];
        return view('statistics.index',$data);
    }

    public function x_axis()
    {
        $start = Carbon::now()->subDay(10);
        $x_axis = [];
        foreach (range(1,10) as $id){
            $start = $start->addDay(1);
            array_push($x_axis,$start->format('m/d'));
        }
        return $x_axis;
    }
}
