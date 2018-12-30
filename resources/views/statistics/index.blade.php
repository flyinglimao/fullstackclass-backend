
@extends('layouts.master')

@section('title','統計列表')

@section('index',route('statistics.index'))

@section('type','Statistics')

@section('content')
<div class="main-content-inner"><!--不一樣-->
    <!-- overview area start -->
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Overview</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected>Last 24 Hours</option>
                            <option value="0">01 July 2018</option>
                        </select>
                    </div>
                    <div id="verview-shart"></div>
                </div>
            </div>
        </div>
        {{--<div class="col-xl-3 col-lg-4 coin-distribution">--}}
            {{--<div class="card h-full">--}}
                {{--<div class="card-body">--}}
                    {{--<h4 class="header-title mb-0">Coin Distribution</h4>--}}
                    {{--<div id="coin_distribution"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <!-- overview area end -->
</div>

{{--<script>--}}
    {{--/*--------------  overview-chart start ------------*/--}}
    {{--if ($('#verview-shart').length) {--}}
        {{--var myConfig = {--}}
            {{--"type": "line",--}}

            {{--"scale-x": { //X-Axis--}}
                {{--"labels": ["1", "11", "21", "31", "41", "51", "61", "71", "81", "91", "101"],--}}
                {{--"label": {--}}
                    {{--"font-size": 14,--}}
                    {{--"offset-x": 0,--}}
                {{--},--}}
                {{--"item": { //Scale Items (scale values or labels)--}}
                    {{--"font-size": 10,--}}
                {{--},--}}
                {{--"guide": { //Guides--}}
                    {{--"visible": false,--}}
                    {{--"line-style": "solid", //"solid", "dotted", "dashed", "dashdot"--}}
                    {{--"alpha": 1--}}
                {{--}--}}
            {{--},--}}
            {{--"plot": { "aspect": "spline" },--}}
            {{--"series": [{--}}
                {{--"values": [20, 25, 30, 35, 45, 40, 40, 35, 25, 57, 40, 50],--}}
                {{--"line-color": "#F0B41A",--}}
                {{--/* "dotted" | "dashed" */--}}
                {{--"line-width": 5 /* in pixels */ ,--}}
                {{--"marker": { /* Marker object */--}}
                    {{--"background-color": "#D79D3B",--}}
                    {{--/* hexadecimal or RGB value */--}}
                    {{--"size": 5,--}}
                    {{--/* in pixels */--}}
                    {{--"border-color": "#D79D3B",--}}
                    {{--/* hexadecimal or RBG value */--}}
                {{--}--}}
            {{--},--}}
                {{--{--}}
                    {{--"values": [40, 45, 30, 20, 30, 35, 45, 55, 40, 30, 55, 30],--}}
                    {{--"line-color": "#0884D9",--}}
                    {{--/* "dotted" | "dashed" */--}}
                    {{--"line-width": 5 /* in pixels */ ,--}}
                    {{--"marker": { /* Marker object */--}}
                        {{--"background-color": "#067dce",--}}
                        {{--/* hexadecimal or RGB value */--}}
                        {{--"size": 5,--}}
                        {{--/* in pixels */--}}
                        {{--"border-color": "#067dce",--}}
                        {{--/* hexadecimal or RBG value */--}}
                    {{--}--}}
                {{--}--}}
            {{--]--}}
        {{--};--}}

        {{--zingchart.render({--}}
            {{--id: 'verview-shart',--}}
            {{--data: myConfig,--}}
            {{--height: "100%",--}}
            {{--width: "100%"--}}
        {{--});--}}
    {{--}--}}

    {{--/*--------------  overview-chart END ------------*/--}}
{{--</script>--}}

@endsection
