@extends('layouts.master')

@section('title','商品列表')

@section('content')
    <style>
        .simple {
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        .mybtn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .uniform_label_length{
            width: 60px;
        }

    </style>
    <script>
        $(document).ready(function(){
            function presend(){
                let target = $(".dynamic");
                let myid = target.attr("id");                //找dynamic class的 id: category_id
                let cat_value = target.val();                    //獲得dynamic class的 value
                let dependent = target.data('dependent');    //獲得dynamic class的 dependent
                let _token=$('input[name="_token"]').val();
                let sub_value = $('#sub_id').val();
                console.log(myid);
                console.log('|'+cat_value+'|');
                console.log(dependent);
                console.log(sub_value);
                $.ajax({
                    url:"{{route('dynamicdependent.prefetch')}}",
                    method:"POST",
                    data:{
                        select:myid,
                        sub_id:sub_value,
                        cat_id:cat_value,
                        _token:_token,
                        dependent:dependent,
                    },
                    success:function (result) {
                        $('#'+dependent).html(result);
                    }
                });
            }
            presend();
        });
    </script>
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <!-- start 進階搜尋-->
            <div class="card">
                <div class="card-body">
                    <div id="accordion1" class="according">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#accordion11">進階搜尋</a>
                            </div>
                            <div id="accordion11" class="collapse" data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <h4 class="header-title mb-0">
                                            搜尋方式 {{'最大id'.$max_id}}
                                        </h4>
                                    </div>
                                    <div class="market-status-table mt-4">
                                        <form  method="get" id="this_form" action="{{route('products.index')}}">
                                            <div>
                                                <label for="category_id" class="col-form-label uniform_label_length">主分類</label>
                                                <select name="category_id" class="dynamic simple col-sm-3" id="category_id" data-dependent="subcategory_id" >
                                                    <option value="">請選擇</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}"{{ (request('category_id') == $category->id)?"selected" : ""}}>
                                                            {{$category->name}}</option>
                                                    @endforeach
                                                </select>

                                                <input type="hidden" value="{{request('subcategory_id')}}" id="sub_id">
                                                <label for="subcategory_id" class="col-form-label uniform_label_length">次分類</label>
                                                <select name="subcategory_id" class="simple col-sm-3" id="subcategory_id">
                                                    <option value="">請選擇</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="stock" class="col-form-label uniform_label_length" >庫存</label>
                                                <input type="text" name="stock" class="simple col-sm-3" id="stock" value="{{request('stock')}}">
                                                <label for="name" class="col-form-label uniform_label_length">名稱</label>
                                                <input type="text" name="name" class="simple col-sm-3" id="name" value="{{request('name')}}">
                                            </div>
                                            <div>
                                                <label for="orderby" class="col-form-label uniform_label_length">排序方式</label>
                                                <select name="" id="orderby" class="simple col-sm-3">
                                                    <option value="">test1</option>
                                                    <option value="">test2</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button type="submit" class="mybtn btn-primary mt-4 pr-4 pl-4">查詢</button>
                                            </div>

                                        </form>
                                    </div>
                                    {{csrf_field()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end   進階搜尋-->

            <!-- start 商品列表-->
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">
                            @if(Request::url() != Request::fullurl())
                                搜尋結果: {{$total.'筆資料'}}
                            @else
                                商品目錄
                            @endif
                        </h4>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    {{--<td class="mv-icon">ID</td>--}}
                                    <td class="coin-name">書名</td>

                                    <td class="attachments">主分類</td>
                                    <td class="attachments">次分類</td>
                                    <td class="attachments">出版時間</td>
                                    <td class="attachments">特價</td>
                                    <td class="buy">庫存</td>
                                    <td class="sell">上架時間</td>
                                    <td class="attachments">圖片</td>
                                    <td class="attachments">
                                        <a href="{{route('products.create')}}" class="btn btn-xs btn-success">新增商品</a>
                                    </td>
                                </tr>
                                @foreach($products as $product)
                                <tr>
                                    <td class="coin-name">{{$product->title}} </td>

                                    <td class="attachments">{{$product->category->name}} </td>
                                    <td class="attachments">{{$product->subcategory->name}} </td>
                                    <td class="attachments">{{$product->publish_year}}</td>
                                    <td class="attachments">{{$product->sale_price}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                    <td class="buy">{{$product->stock}} </td>
                                    <td class="sell">{{$product->updated_at}} </td>
                                    <td class="sell">
                                        <img src="{{asset($product->picture)}}" alt="no picture" class="avatar user-thumb" style="width: 50px;height: 50px;"> </td>

                                    <td class="attachments">
                                        <a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-xs btn-primary">編輯</a>
                                        <button onclick='confirmDelete("{{$product->id}}","{{$product->title}}","商品","products")' class="btn btn-xs btn-danger">刪除</button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    {{$products->appends(Request::except('page'))->onEachSide(1)->links()}}
                </div>
            </div>
            <!-- end   商品列表-->
        </div>
    </div>


</div>
@endsection
