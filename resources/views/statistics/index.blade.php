
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
                        <h4 class="header-title mb-0">銷售狀況</h4>
                        <select name="type" class="custome-select border-0 pr-3" id="myselect">
                            <option value="day" >Recent day</option>
                            <option value="week" selected>Recent week</option>
                            <option value="month">Recent month</option>
                        </select>
                        {{csrf_field()}}
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
    <button id="click1">click me</button>
</div>

{{--/*--------------  overview-chart start ------------*/--}}
<script>
    $(document).ready(function () {
        let axis = '{{$x_axis}}';
        let dataset = '{{$dataset}}';
        axis = axis.replace(/&quot;/g,'"');
        dataset = dataset.replace(/&quot;/g,'"');
        var myConfig = {
            "type": "line",

            "scale-x": { //X-Axis
                "labels": JSON.parse(axis),
                "label": {
                    "font-size": 14,
                    "offset-x": 0,
                },
                "item": { //Scale Items (scale values or labels)
                    "font-size": 10,
                },
                "guide": { //Guides
                    "visible": false,
                    "line-style": "solid", //"solid", "dotted", "dashed", "dashdot"
                    "alpha": 1
                }
            },
            "plot": { "aspect": "spline" },
            "series": [{
                "values": JSON.parse(dataset),
                "line-color": "#0884D9",
                /* "dotted" | "dashed" */
                "line-width": 5 /* in pixels */ ,
                "marker": { /* Marker object */
                    "background-color": "#067dce",
                    /* hexadecimal or RGB value */
                    "size": 5,
                    /* in pixels */
                    "border-color": "#067dce",
                    /* hexadecimal or RBG value */
                }
            }]
        };
        zingchart.render({
            id: 'verview-shart',
            data: myConfig,
            height: "100%",
            width: "100%"
        });


        $('#myselect').change(function () {
            let _token=$('input[name="_token"]').val();
            $.ajax({
                url:"{{route('ajax.label')}}",
                method:"POST",
                data:{
                    type:$('#myselect').val(),
                    _token:_token
                },
                success:function (labels) {
                    console.log(labels);
                    // labels = labels.replace(/&quot;/g,'"');
                    console.log(labels);
                    myConfig['scale-x']['labels'] = JSON.parse(labels);
                    $.ajax({
                        url:"{{route('ajax.dataset')}}",
                        method:"POST",
                        data:{
                            type:$('#myselect').val(),
                            array:labels,
                            _token:_token
                        },
                        success:function (dataval) {
                            console.log(dataval);
                            dataval = dataval.replace(/&quot;/g,'"');
                            console.log(dataval);
                            myConfig['series'][0]['values'] = JSON.parse(dataval);
                            zingchart.render({
                                id: 'verview-shart',
                                data: myConfig,
                                height: "100%",
                                width: "100%"
                            });

                        }
                    });

                }
            })

        })
    });


</script>
{{--/*--------------  overview-chart END ------------*/--}}

@endsection
