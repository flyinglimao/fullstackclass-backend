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
                            @if(session()->has('data'))
                                警告!此搜尋功能重整後即消失
                            @endif
                        </h4>

                        <form  method="post" id="this_form" action="{{route('products.show')}}">
                            @csrf
                            <label for="cat_id" >搜尋分類</label>
                            <select name="category_id" class="custome-select border-0 pr-3" id="cat_id" >

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{ (old('category_id') == $category->id)?"selected" : ""}}>
                                         {{$category->name}}</option>
                                @endforeach
                             </select>
                            <button type="submit">查詢</button>
                        </form>
                        <script>
                            function selectfunc(){
                                let target = $('select[name=category_id]').val();
                                let urls = "{{route('products.show','replacement')}}".replace('replacement',target);
                                $('#this_form').attr('action',urls);
                                $('#this_form').submit();
                            }
                        </script>

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


    <!-- start刪除警告視窗-->
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
    <!-- end刪除警告視窗-->
    <script>
        function isSubmit() {
            $('button#is_submit').attr('disabled',true);

            let url = '{{route('products.destroy', ':product')}}';
            url = url.replace(':product', $('#myNumber').val());

            $('#del').attr('action', url);
            $('#del').submit();
        }
    </script>
    <script>
        function confirmDelete(productId,productTitle) {
            $('#confirmModalBody').text('確定刪除商品'+productId+'號 '+productTitle+" 嗎?");
            $('#confirmModal').modal('toggle');
            $('input#myNumber').val(productId);
        }
    </script>
    <!-- market value area end -->
</div>
@endsection
