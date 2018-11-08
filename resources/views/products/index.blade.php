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
                        <h4 class="header-title mb-0">商品目錄</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected>Last 24 Hours</option>
                            <option value="0">01 July 2018</option>
                        </select>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    {{--<td class="mv-icon">ID</td>--}}
                                    <td class="coin-name">書名</td>

                                    <td class="attachments">種類</td>
                                    <td class="attachments">定價</td>
                                    <td class="attachments">特價</td>
                                    <td class="buy">庫存</td>
                                    <td class="sell">上架時間</td>
                                    <td class="attachments">
                                        <a href="{{route('products.create')}}" class="btn btn-xs btn-success">新增商品</a>
                                    </td>
                                </tr>
                                @foreach($products_list as $product)
                                <tr>
                                    <td class="coin-name">{{$product->title}} </td>

                                    <td class="attachments">{{$product->category->name}} </td>
                                    <td class="attachments">{{$product->list_price}}</td>
                                    <td class="attachments">{{$product->sale_price}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                    <td class="buy">{{$product->stock}} </td>
                                    <td class="sell">{{$product->updated_at}} </td>
                                    <td class="attachments">
                                        <a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-xs btn-primary">編輯</a>
                                        <button onclick='confirmDelete("{{$product->id}}","{{$product->title}}")' class="btn btn-xs btn-danger">刪除</button>
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

    <script>
        function confirmDelete(productId,productTitle) {
            $('#confirmModalBody').text('確定刪除商品'+productId+'號 '+productTitle+" 嗎?");
            $('#confirmModal').modal('toggle');
            $('input#myNumber').val(productId);
        }
    </script>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">警告</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                </div>
                <div class="modal-footer">
                    <form method="post" onsubmit="isSubmit()" id="del">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                        <button type="submit" class="btn btn-primary" id="is_submit">確認</button>
                        <input type="hidden" id="myNumber" name="id" >
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function isSubmit() {
            $('button#is_submit').attr('disabled',true);

            let url = '{{route('products.destroy', ':product')}}';
            url = url.replace(':product', $('#myNumber').val());

            $('#del').attr('action', url);
            $('#del').submit();
        }
    </script>
    <!-- market value area end -->
</div>
@endsection
