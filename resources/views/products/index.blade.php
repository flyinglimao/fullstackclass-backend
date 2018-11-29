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
                        <h4 class="header-title mb-0">
                            商品目錄
                        </h4>

                        <form  method="get" id="this_form" action="{{route('products.index')}}">

                            <label for="category_id" >主分類</label>
                            <select name="category_id" class="dynamic" id="category_id" data-dependent="subcategory_id">
                                <option value="">請選擇</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"{{ (old('category_id') == $category->id)?"selected" : ""}}>
                                            {{$category->name}}</option>
                                @endforeach
                             </select>


                            <label for="subcategory_id">次分類</label>
                            <select name="subcategory_id" id="subcategory_id">
                                <option value="">請選擇</option>
                            </select>


                            <button type="submit">查詢</button>
                        </form>
                        {{csrf_field()}}
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    {{--<td class="mv-icon">ID</td>--}}
                                    <td class="coin-name">書名</td>

                                    <td class="attachments">主分類</td>
                                    <td class="attachments">次分類</td>
                                    <td class="attachments">定價</td>
                                    <td class="attachments">特價</td>
                                    <td class="buy">庫存</td>
                                    <td class="sell">上架時間</td>
                                    <td class="attachments">
                                        <a href="{{route('products.create')}}" class="btn btn-xs btn-success">新增商品</a>
                                    </td>
                                </tr>
                                @foreach($products as $product)
                                <tr>
                                    <td class="coin-name">{{$product->title}} </td>

                                    <td class="attachments">{{$product->category->name}} </td>
                                    <td class="attachments">{{$product->subcategory->name}} </td>
                                    <td class="attachments">{{$product->list_price}}</td>
                                    <td class="attachments">{{$product->sale_price}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                    <td class="buy">{{$product->stock}} </td>
                                    <td class="sell">{{$product->updated_at}} </td>
                                    <td class="attachments">
                                        <a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-xs btn-primary">編輯</a>
                                        <button onclick='confirmDelete("{{$product->id}}","{{$product->title}}","商品","products")' class="btn btn-xs btn-danger">刪除</button>
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


</div>
@endsection
