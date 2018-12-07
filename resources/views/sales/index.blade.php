
@extends('layouts.master')

@section('title','庫存變化列表')

@section('index',route('sales.index'))

@section('type','Sale Index')

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
                                            <form  method="get" id="this_form" action="{{route('sales.index')}}">
                                                <div>
                                                    <label for="id" class="col-form-label uniform_label_length">ID</label>
                                                    <input type="text" class="simple col-sm-3"id="id" name="id" value="{{request('id')}}">
                                                </div>

                                                <div>
                                                    <label for="products_id" class="col-form-label uniform_label_length" >商品id</label>
                                                    <input type="text" name="products_id" class="simple col-sm-3" id="products_id" value="{{request('products_id')}}">
                                                    <label for="product_name" class="col-form-label uniform_label_length">商品名稱</label>
                                                    <input type="text" name="product_name" class="simple col-sm-3" id="product_name" value="{{request('product_name')}}">
                                                </div>
                                                <div>
                                                    <label for="order_id" class="col-form-label uniform_label_length">訂單id</label>
                                                    <input type="text" name="order_id" class="simple col-sm-3" id="order_id" value="{{request('order_id')}}">
                                                    <label for="invoice_number" class="col-form-label uniform_label_length">訂單發票號碼</label>
                                                    <input type="text" name="invoice_number" class="simple col-sm-3" id="invoice_number" value="{{request('invoice_number')}}">

                                                </div>
                                                <div>
                                                    <label for="orderby" class="col-form-label uniform_label_length">排序方式</label>
                                                    <select name="item" id="orderby" class="simple col-sm-3" >
                                                        <option value="">請選擇</option>
                                                        <option value="id" {{ (request('item') == 'id'?'selected':'') }}>ID</option>
                                                        <option value="change"{{ (request('item') == 'change'?'selected':'') }}>變化量</option>
                                                        <option value="products_id"{{ (request('item') == 'products_id'?'selected':'') }}>商品id</option>
                                                        <option value="order_id"{{ (request('item') == 'order_id'?'selected':'') }}>訂單id</option>
                                                        <option value="created_at"{{ (request('item') == 'created_at'?'selected':'') }}>製造日期</option>
                                                    </select>
                                                    <select name="order" class="simple col-sm-3">
                                                        <option value="">請選擇</option>
                                                        <option value="desc" {{ (request('order') == 'desc'?'selected':'') }}>由高至低(以前到現在)</option>
                                                        <option value="asc"  {{ (request('order') == 'asc'?'selected':'') }}>由低至高(現在到以前)</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <span class="text-muted mb-3 d-block">商品標籤:</span>
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                @if(Request::url() != Request::fullurl())
                                    搜尋結果: {{$total.'筆資料'}}
                                @else
                                    庫存變化目錄: {{$total.'筆資料'}}
                                @endif
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="attachments">編號</td>
                                        <td class="attachments">變化量</td>
                                        <td class="attachments">商品編號</td>
                                        <td class="attachments">商品名稱</td>
                                        <td class="attachments">訂單編號</td>
                                        <td class="attachments">訊息</td>
                                        <td class="attachments">日期</td>

                                        <td class="attachments">
                                            <a href="{{route('sales.create')}}" class="btn btn-xs btn-success" style="width: 120px">新增庫存變化</a>
                                        </td>
                                    </tr>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td class="attachments">{{$sale->id}} </td>

                                            <td class="attachments">{{$sale->change}}
                                                @if ($sale->change<0)
                                                    <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon">
                                                @else
                                                    <img src="{{asset('images/icon/market-value/triangle-up.png')}}" alt="icon">
                                                @endif
                                            </td>
                                            <td class="attachments">{{$sale->products_id}}</td>
                                            <td class="attachments">{{$sale->product->title}}</td>
                                            <td class="attachments">{{$sale->order_id}} </td>
                                            <td class="attachments">{{$sale->message}} </td>
                                            <td class="attachments">{{$sale->created_at}}</td>
                                            <td class="attachments"></td>

                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$sales->appends(Request::except('page'))->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
