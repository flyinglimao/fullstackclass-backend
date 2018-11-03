@extends('layouts.master')

@section('title','新增商品')

@section('content')


    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增商品</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('products.store')}}" method="post" onsubmit="isSubmit()">
                                    @csrf
                                    <div class="form-group">
                                        <button class="form-control" type="submit" id="is_submit1">提交</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">title</label>
                                        <input class="form-control" type="text" placeholder="請輸入title" id="example-text-input" name="title" value="測試title">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">subtitle</label>
                                        <input class="form-control" type="text" placeholder="請輸入subtitle" id="example-search-input" name="subtitle" value="測試subtitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-textarea-input" class="col-form-label">description</label>
                                        <textarea  class="form-control" cols="20" rows="4" placeholder="請輸入description" id="example-textarea-input" name="description">測試description</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">type</label>
                                        <input class="form-control" type="text" placeholder="請輸入type" id="example-url-input" name="type" value="2">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-form-label">author</label>
                                        <input class="form-control" type="tel" placeholder="請輸入author" id="example-tel-input" name="author" value="測試author">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="">publisher</label>
                                        <input class="form-control" type="text" placeholder="請輸入publisher" id="inputPassword"  name="publisher" value="測試publisher">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-number-input" class="col-form-label">isbn</label>
                                        <input class="form-control" type="text" placeholder="請輸入isbn" id="example-number-input" name="isbn" value="0000000000000">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-category-input" class="col-form-label">category</label>
                                        <input class="form-control" type="text" placeholder="請輸入category" id="example-category-input" name="category" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-list_price-input" class="col-form-label">list_price</label>
                                        <input class="form-control" type="text" placeholder="請輸入list_price" id="example-list_price-input" name="list_price" value="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-sale_price-input" class="col-form-label">sale_price</label>
                                        <input class="form-control" type="text" placeholder="請輸入sale_price" id="example-sale_price-input" name="sale_price" value="123">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-stock-input" class="col-form-label">stock</label>
                                        <input class="form-control" type="text" placeholder="請輸入stock" id="example-stock-input" name="stock" value="12">
                                    </div>
                                    <div class="form-group">
                                        <button class="form-control" type="submit" id="is_submit2">提交</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Textual inputs end -->
                    <script>
                        function isSubmit() {
                            $('button#is_submit1').attr('disabled',true);
                            $('button#is_submit2').attr('disabled',true);
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
    <script>

    </script>

@endsection