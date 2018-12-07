@extends('layouts.master')

@section('title','商品列表')

@section('index',route('products.index'))

@section('type','Product Index')

@section('content')

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
                            <div id="accordion11" class="collapse " data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <h4 class="header-title mb-0">
                                            搜尋方式
                                        </h4>
                                    </div>
                                    <div class="market-status-table mt-4">
                                        <form  method="get" id="this_form" action="{{route('products.index')}}">
                                            <div>
                                                <label for="id" class="col-form-label uniform_label_length">ID</label>
                                                <input type="text" class="simple col-sm-3"id="id" name="id" value="{{request('id')}}">
                                            </div>
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
                                                <select name="item" id="orderby" class="simple col-sm-3" >
                                                    <option value="">請選擇</option>
                                                    <option value="sale_price" {{ (request('item') == 'sale_price'?'selected':'') }}>售價</option>
                                                    <option value="stock"{{ (request('item') == 'stock'?'selected':'') }}>庫存</option>
                                                    <option value="created_at"{{ (request('item') == 'created_at'?'selected':'') }}>建立時間</option>
                                                    <option value="isbn"{{ (request('item') == 'isbn'?'selected':'') }}>ISBN</option>
                                                    <option value="publish_year" {{ (request('item') == 'publish_year'?'selected':'') }}>出版時間</option>
                                                </select>
                                                <select name="order" class="simple col-sm-3">
                                                    <option value="">請選擇</option>
                                                    <option value="desc" {{ (request('order') == 'desc'?'selected':'') }}>由高至低(以前到現在)</option>
                                                    <option value="asc"  {{ (request('order') == 'asc'?'selected':'') }}>由低至高(現在到以前)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <span class="text-muted mb-3 d-block">標籤:</span>
                                                @foreach($tags as $id => $tag)
                                                    @if($id!=0 && $id%4==0)
                                                        <div class="mb-3"></div>
                                                    @endif
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" name="tagss[]" value="{{$tag->id}}" class="custom-control-input"
                                                               {{ in_array($tag->id,request('tagss',[]))?'checked':'' }} id="customCheck{{$id}}">
                                                        <label class="custom-control-label" for="customCheck{{$id}}" style="width:100px">#{{$tag->name}}</label>
                                                    </div>
                                                @endforeach
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
                                商品目錄: {{$total.'筆資料'}}
                            @endif
                        </h4>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    {{--<td class="mv-icon">ID</td>--}}

                                    <td class="coin-name">ID</td>
                                    <td class="attachments">書名</td>
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
                                    <td class="coin-name">{{$product->id}} </td>
                                    <td class="attachments">{{$product->title}} </td>

                                    <td class="attachments">{{$product->category->name}} </td>
                                    <td class="attachments">{{$product->subcategory->name}} </td>
                                    <td class="attachments">{{$product->publish_year}}</td>
                                    <td class="attachments">{{$product->sale_price}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                    <td class="buy">{{$product->stock}} </td>
                                    <td class="sell">{{$product->created_at}} </td>
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

</div>
@endsection
