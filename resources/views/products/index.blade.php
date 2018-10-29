@extends('layouts.master')

@section('title','商品列表')

@section('content')
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Market Value And Trends</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected>Last 24 Hours</option>
                            <option value="0">01 July 2018</option>
                        </select>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    <td class="mv-icon">ID</td>
                                    <td class="coin-name">書名</td>
                                    <td class="buy">副標題</td>
                                    <td class="sell">敘述</td>
                                    <td class="attachments">種類</td>
                                    <td class="attachments">定價</td>
                                    <td class="attachments">特價</td>
                                    <td class="attachments"></td>
                                </tr>
                                @foreach($products_list as $product)
                                <tr>
                                    <td class="mv-icon">{{$product->id}} </td>
                                    <td class="coin-name">{{$product->title}} </td>
                                    <td class="buy">{{$product->subtitle}} </td>
                                    <td class="sell">{{$product->description}} </td>
                                    <td class="attachments">{{$product->category}} </td>
                                    <td class="attachments">{{$product->list_price}}</td>
                                    <td class="attachments">{{$product->sale_price}} <img src="images/icon/market-value/triangle-down.png" alt="icon"></td>
                                    <td class="attachments">
                                        <a href="#" class="btn btn-xs btn-primary">編輯</a>
                                        <a href="#" class="btn btn-xs btn-danger">刪除</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- market value area end -->
</div>
@endsection
