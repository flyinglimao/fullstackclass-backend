
@extends('layouts.master')

@section('title','庫存變化列表')

@section('index',route('sales.index'))

@section('type','Sale')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                庫存變化列表
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
                                        <td class="attachments">訂單編號</td>
                                        <td class="attachments">訊息</td>
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
                                            <td class="attachments">{{$sale->order_id}} </td>
                                            <td class="attachments">{{$sale->message}} </td>
                                            <td class="attachments">
                                                <a href="#" class="btn btn-xs btn-primary" style="width: 120px">編輯</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$sales->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
