
@extends('layouts.master')

@section('title','訂單列表')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                訂單列表
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="attachments">編號</td>

                                        <td class="attachments">狀態</td>
                                        <td class="attachments">付費方式</td>
                                        <td class="attachments">付款時間</td>
                                        <td class="attachments">訊息</td>
                                        <td class="attachments">運送方式</td>
                                        <td class="attachments">物流公司</td>
                                        <td class="attachments">商品名稱</td>
                                        <td class="attachments">總金額</td>
                                        <td class="attachments">收件人</td>
                                        <td class="attachments">下定單者</td>

                                        <td class="attachments">

                                        </td>
                                    </tr>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="attachments">{{$order->id}} </td>
                                            <td class="attachments">{{$order->state}} </td>
                                            <td class="attachments">{{$order->pay_method}} </td>
                                            <td class="attachments">{{json_decode($order->payment_information)->time->date }} </td>
                                            <td class="attachments">{{$order->message}} </td>
                                            <td class="attachments">{{$order->ship_method}} </td>
                                            <td class="attachments">{{$order->ship_information}} </td>
                                            <td class="attachments">{{\App\Product::find(json_decode($order->products)->product_id)->title }} </td>
                                            <td class="attachments">{{json_decode($order->payment_information)->total }} </td>
                                            <td class="attachments">{{$order->receiver}} </td>
                                            <td class="attachments">{{$order->user->name}} </td>

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
