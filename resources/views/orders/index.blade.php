
@extends('layouts.master')

@section('title','訂單列表')

@section('index',route('orders.index'))

@section('type','Order')

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
                                            <form  method="get" id="this_form" action="{{route('orders.index')}}">
                                                <div>
                                                    <label for="invoice_number" class="col-form-label uniform_label_length">發票號碼</label>
                                                    <input type="text" class="simple col-sm-3"id="invoice_number" name="invoice_number" value="{{request('invoice_number')}}">
                                                </div>
                                                <div>
                                                    <label for="user_id" class="col-form-label uniform_label_length" >購買會員ID</label>
                                                    <input type="text" name="user_id" class="simple col-sm-3" id="user_id" value="{{request('user_id')}}">
                                                    <label for="user_name" class="col-form-label uniform_label_length" >購買會員</label>
                                                    <input type="text" name="user_name" class="simple col-sm-3" id="user_name" value="{{request('user_name')}}">
                                                </div>
                                                <div>
                                                    <label for="receiver" class="col-form-label uniform_label_length">收件者</label>
                                                    <input type="text" name="receiver" class="simple col-sm-3" id="receiver" value="{{request('receiver')}}">
                                                    <label for="receiver_phone" class="col-form-label uniform_label_length">收件者電話</label>
                                                    <input type="text" name="receiver_phone" class="simple col-sm-3" id="receiver_phone" value="{{request('receiver_phone')}}">
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
                                                <div>
                                                    <button type="submit" class="mybtn btn-primary mt-4 pr-4 pl-4">查詢</button>
                                                </div>

                                            </form>
                                        </div>
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
                                    訂單目錄
                                @endif
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        <td class="attachments">發票號碼</td>
                                        <td class="attachments">下定單者</td>
                                        <td class="attachments">收件人</td>
                                        <td class="attachments">收件人電話</td>
                                        <td class="attachments">總金額</td>
                                        <td class="attachments">狀態</td>
                                        <td class="attachments">付費方式</td>

                                        <td class="attachments">訊息</td>
                                        <td class="attachments">運送方式</td>
                                        <td class="attachments">物流公司</td>
                                        <td class="attachments">商品名稱</td>

                                        <td class="attachments">付款時間</td>

                                        <td class="attachments">

                                        </td>
                                    </tr>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="attachments">{{$order->invoice_number}} </td>
                                            <td class="attachments">{{$order->user->name}} </td>
                                            <td class="attachments">{{$order->receiver}} </td>
                                            <td class="attachments">{{$order->receiver_phone}} </td>
                                            <td class="attachments">{{json_decode($order->payment_information)->total }} </td>
                                            <td class="attachments">{{$order->state}} </td>
                                            <td class="attachments">{{$order->pay_method}} </td>

                                            <td class="attachments">{{$order->message}} </td>
                                            <td class="attachments">{{$order->ship_method}} </td>
                                            <td class="attachments">{{$order->ship_information}} </td>
                                            <td class="attachments">{{\App\Product::find(array_keys(json_decode($order->products,true)))[0]->title }} </td>


                                            <td class="attachments">{{json_decode($order->payment_information)->time->date }} </td>

                                            <td class="attachments">
                                                <a href="{{route('orders.edit',$order->id)}}" class="btn btn-xs btn-primary" style="width:120px">編輯</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$orders->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
